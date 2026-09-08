<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\Review;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard admin avec statistiques globales.
     */
    public function dashboard()
    {
        $stats = [
            'clients'            => User::where('role', 'client')->count(),
            'transporteurs'      => User::where('role', 'transporteur')->count(),
            'vehicles'           => Vehicle::count(),
            'transport_requests' => TransportRequest::count(),
            'offers'             => Offer::count(),
            'missions'           => Mission::count(),
            'missions_delivered' => Mission::where('status', 'delivered')->count(),
            'reviews'            => Review::count(),
        ];

        $recentRequests = TransportRequest::with('client')
            ->latest()
            ->limit(5)
            ->get();

        $recentMissions = Mission::with(['client', 'transporteur'])
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentRequests', 'recentMissions'));
    }

    /**
     * Liste de tous les utilisateurs.
     */
    public function users()
    {
        $users = User::withCount([
            'transportRequests',
            'vehicles',
            'offers',
            'missionsAsClient',
            'missionsAsTransporteur'
        ])
        ->latest()
        ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    /**
     * Detail d'un utilisateur.
     */
    public function showUser(User $user)
    {
        $user->load(['transportRequests', 'vehicles', 'offers', 'missionsAsClient', 'missionsAsTransporteur', 'reviewsReceived']);
        return view('admin.users.show', compact('user'));
    }

    /**
     * Activer/Desactiver un utilisateur (si champ active existe).
     * Ici on change le role pour marquer desactive si besoin.
     */
    public function toggleUser(User $user)
    {
        // Empecher de se desactiver soi-meme
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas modifier votre propre compte.');
        }

        // Toggle: on utilise un champ 'active' si dispo, sinon on simule
        if ($user->hasAttribute('active')) {
            $user->update(['active' => !$user->active]);
        }

        return back()->with('success', 'Statut utilisateur mis à jour.');
    }

    /**
     * Supprimer un utilisateur.
     */
    public function destroyUser(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }

    /**
     * Liste de toutes les demandes.
     */
    public function transportRequests()
    {
        $requests = TransportRequest::with('client')
            ->withCount('offers')
            ->latest()
            ->paginate(20);

        return view('admin.transport-requests.index', compact('requests'));
    }

    /**
     * Detail d'une demande.
     */
    public function showTransportRequest(TransportRequest $transportRequest)
    {
        $transportRequest->load(['client', 'offers.transporteur', 'offers.vehicle', 'mission.transporteur']);

        return view('admin.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Supprimer une demande (admin).
     */
    public function destroyTransportRequest(TransportRequest $transportRequest)
    {
        // Empecher suppression si mission active
        if ($transportRequest->mission && !in_array($transportRequest->mission->status, ['delivered', 'cancelled'])) {
            return back()->with('error', 'Impossible de supprimer une demande avec une mission active.');
        }

        $transportRequest->delete();

        return redirect()->route('admin.transport-requests.index')->with('success', 'Demande supprimée avec succès.');
    }

    /**
     * Liste de toutes les offres.
     */
    public function offers()
    {
        $offers = Offer::with(['transportRequest.client', 'transporteur', 'vehicle'])
            ->latest()
            ->paginate(20);

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Liste de toutes les missions.
     */
    public function missions()
    {
        $missions = Mission::with(['client', 'transporteur', 'transportRequest', 'vehicle', 'offer'])
            ->latest()
            ->paginate(20);

        return view('admin.missions.index', compact('missions'));
    }

    /**
     * Liste de tous les vehicules.
     */
    public function vehicles()
    {
        $vehicles = Vehicle::with('transporteur')
            ->latest()
            ->paginate(20);

        return view('admin.vehicles.index', compact('vehicles'));
    }

    /**
     * Liste de toutes les evaluations.
     */
    public function reviews()
    {
        $reviews = Review::with(['client', 'transporteur', 'mission.transportRequest'])
            ->latest()
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Supprimer une evaluation (admin).
     */
    public function destroyReview(Review $review)
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'Avis supprimé avec succès.');
    }
}
