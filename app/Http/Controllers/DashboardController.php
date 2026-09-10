<?php

namespace App\Http\Controllers;

use App\Models\TransportRequest;

class DashboardController extends Controller
{
    /**
     * Dashboard client — statistiques et activité récente.
     */
    public function client()
    {
        $user = auth()->user();

        $stats = [
            'requests'            => $user->transportRequests()->count(),
            'pending_requests'    => $user->transportRequests()->where('status', 'pending')->count(),
            'requests_with_offers' => $user->transportRequests()
                ->whereHas('offers')
                ->where('status', 'pending')
                ->count(),
            'missions'             => $user->missionsAsClient()->count(),
            'active_missions'      => $user->missionsAsClient()->whereIn('status', ['pending', 'accepted', 'in_delivery'])->count(),
            'delivered_missions'   => $user->missionsAsClient()->where('status', 'delivered')->count(),
        ];

        $recentRequests = $user->transportRequests()->withCount('offers')->latest()->limit(3)->get();
        $recentMissions = $user->missionsAsClient()->with('transporteur')->latest()->limit(3)->get();

        return view('client.dashboard', compact('stats', 'recentRequests', 'recentMissions'));
    }

    /**
     * Dashboard transporteur — statistiques et activité récente.
     */
    public function transporteur()
    {
        $user = auth()->user();

        $stats = [
            'vehicles'            => $user->vehicles()->count(),
            'available_vehicles'  => $user->vehicles()->where('available', true)->count(),
            'offers'              => $user->offers()->count(),
            'pending_offers'      => $user->offers()->where('status', 'pending')->count(),
            'accepted_offers'     => $user->offers()->where('status', 'accepted')->count(),
            'missions'            => $user->missionsAsTransporteur()->count(),
            'active_missions'     => $user->missionsAsTransporteur()->whereIn('status', ['pending', 'accepted', 'in_delivery'])->count(),
            'delivered_missions'  => $user->missionsAsTransporteur()->where('status', 'delivered')->count(),
            'average_rating'      => $user->averageRating(),
            'total_reviews'       => $user->reviewsReceived()->count(),
        ];

        $recentMissions = $user->missionsAsTransporteur()->with('client')->latest()->limit(3)->get();
        $availableRequests = TransportRequest::where('status', 'pending')->count();

        return view('transporteur.dashboard', compact('stats', 'recentMissions', 'availableRequests'));
    }
}