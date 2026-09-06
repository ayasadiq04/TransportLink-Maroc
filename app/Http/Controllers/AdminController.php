<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\Review;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;

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
        $clients       = User::where('role', 'client')->latest()->get();
        $transporteurs = User::where('role', 'transporteur')->latest()->get();
        $admins        = User::where('role', 'admin')->latest()->get();

        return view('admin.users.index', compact('clients', 'transporteurs', 'admins'));
    }

    /**
     * Liste de toutes les demandes.
     */
    public function transportRequests()
    {
        $requests = TransportRequest::with('client')
            ->latest()
            ->paginate(20);

        return view('admin.transport-requests.index', compact('requests'));
    }

    /**
     * Détail d'une demande.
     */
    public function showTransportRequest(TransportRequest $transportRequest)
    {
        $transportRequest->load(['client', 'offers.transporteur', 'offers.vehicle', 'mission']);

        return view('admin.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Liste de toutes les offres.
     */
    public function offers()
    {
        $offers = Offer::with(['transportRequest', 'transporteur', 'vehicle'])
            ->latest()
            ->paginate(20);

        return view('admin.offers.index', compact('offers'));
    }

    /**
     * Liste de toutes les missions.
     */
    public function missions()
    {
        $missions = Mission::with(['client', 'transporteur', 'transportRequest'])
            ->latest()
            ->paginate(20);

        return view('admin.missions.index', compact('missions'));
    }

    /**
     * Liste de toutes les évaluations.
     */
    public function reviews()
    {
        $reviews = Review::with(['client', 'transporteur', 'mission.transportRequest'])
            ->latest()
            ->paginate(20);

        return view('admin.reviews.index', compact('reviews'));
    }
}
