<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Client — formulaire d'évaluation.
     */
    public function create(Mission $mission)
    {
        abort_unless($mission->client_id === Auth::id(), 403);

        // Seule une mission livrée peut être évaluée
        if ($mission->status !== 'delivered') {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous ne pouvez évaluer que les missions livrées.');
        }

        // Vérifier qu'il n'y a pas déjà une évaluation
        if ($mission->review) {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous avez déjà évalué cette mission.');
        }

        $mission->load(['transporteur', 'transportRequest']);

        return view('client.reviews.create', compact('mission'));
    }

    /**
     * Client — enregistrer l'évaluation.
     */
    public function store(Request $request, Mission $mission)
    {
        abort_unless($mission->client_id === Auth::id(), 403);

        if ($mission->status !== 'delivered') {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous ne pouvez évaluer que les missions livrées.');
        }

        // Empêcher les doublons
        if ($mission->review) {
            return redirect()
                ->route('client.missions.show', $mission)
                ->with('error', 'Vous avez déjà évalué cette mission.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'mission_id'      => $mission->id,
            'client_id'       => Auth::id(),
            'transporteur_id' => $mission->transporteur_id,
            'rating'          => $validated['rating'],
            'comment'         => $validated['comment'] ?? null,
        ]);

        return redirect()
            ->route('client.missions.show', $mission)
            ->with('success', 'Votre évaluation a été enregistrée. Merci !');
    }

    /**
     * Profil public d'un transporteur avec ses évaluations.
     */
    public function transporteurProfile(int $id)
    {
        $transporteur = \App\Models\User::where('id', $id)
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
