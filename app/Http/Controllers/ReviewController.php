<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Models\Mission;
use App\Models\Review;
use App\Models\User;
use App\Notifications\NewReviewNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Client — formulaire d'évaluation.
     */
    public function create(Mission $mission)
    {
        if ($mission->status !== 'delivered') {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous ne pouvez évaluer que les missions livrées.');
        }

        if ($mission->review) {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous avez déjà évalué cette mission.');
        }

        $this->authorize('review', $mission);

        $mission->load(['transporteur', 'transportRequest']);

        return view('client.reviews.create', compact('mission'));
    }

    /**
     * Client — enregistrer l'évaluation.
     */
    public function store(StoreReviewRequest $request, Mission $mission)
    {
        $validated = $request->validated();

        $transporteur = $mission->transporteur;

        $review = Review::create([
            'mission_id'      => $mission->id,
            'client_id'       => Auth::id(),
            'transporteur_id' => $mission->transporteur_id,
            'rating'          => $validated['rating'],
            'comment'         => $validated['comment'] ?? null,
        ]);

        $transporteur?->notify(new NewReviewNotification($review));

        return redirect()
            ->route('client.missions.show', $mission)
            ->with('success', 'Votre évaluation a été enregistrée. Merci !');
    }

    /**
     * Profil public d'un transporteur avec ses évaluations.
     */
    public function transporteurProfile(int $id)
    {
        $transporteur = User::where('id', $id)
            ->where('role', 'transporteur')
            ->firstOrFail();

        $reviews = Review::where('transporteur_id', $id)
            ->with('client')
            ->latest()
            ->paginate(10);

        $averageRating = $transporteur->averageRating();
        $totalReviews  = $transporteur->reviewsReceived()->count();

        return view('transporteur.profile', compact(
            'transporteur',
            'reviews',
            'averageRating',
            'totalReviews'
        ));
    }
}
