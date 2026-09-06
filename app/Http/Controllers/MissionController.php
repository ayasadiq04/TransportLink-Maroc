<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MissionController extends Controller
{
    /**
     * Client — liste de ses missions.
     */
    public function clientIndex()
    {
        $missions = Mission::where('client_id', Auth::id())
            ->with(['transportRequest', 'transporteur', 'vehicle', 'review'])
            ->latest()
            ->get();

        return view('client.missions.index', compact('missions'));
    }

    /**
     * Client — détail d'une mission.
     */
    public function clientShow(Mission $mission)
    {
        abort_unless($mission->client_id === Auth::id(), 403);

        $mission->load(['transportRequest', 'transporteur', 'vehicle', 'offer', 'review']);

        return view('client.missions.show', compact('mission'));
    }

    /**
     * Transporteur — liste de ses missions.
     */
    public function transporteurIndex()
    {
        $missions = Mission::where('transporteur_id', Auth::id())
            ->with(['transportRequest', 'client', 'vehicle'])
            ->latest()
            ->get();

        return view('transporteur.missions.index', compact('missions'));
    }

    /**
     * Transporteur — détail d'une mission.
     */
    public function transporteurShow(Mission $mission)
    {
        abort_unless($mission->transporteur_id === Auth::id(), 403);

        $mission->load(['transportRequest', 'client', 'vehicle', 'offer']);

        return view('transporteur.missions.show', compact('mission'));
    }

    /**
     * Transporteur — mettre à jour le statut d'une mission.
     */
    public function updateStatus(Request $request, Mission $mission)
    {
        abort_unless($mission->transporteur_id === Auth::id(), 403);

        $validated = $request->validate([
            'status' => 'required|in:accepted,in_delivery,delivered,cancelled',
        ]);

        // Règles de transition de statut
        $allowedTransitions = [
            'pending'     => ['accepted', 'cancelled'],
            'accepted'    => ['in_delivery', 'cancelled'],
            'in_delivery' => ['delivered'],
        ];

        $currentStatus = $mission->status;

        if (!isset($allowedTransitions[$currentStatus]) ||
            !in_array($validated['status'], $allowedTransitions[$currentStatus])) {
            return back()->with('error', 'Transition de statut non autorisée.');
        }

        $data = ['status' => $validated['status']];

        // Si livrée, enregistrer la date de livraison
        if ($validated['status'] === 'delivered') {
            $data['delivered_at'] = now();

            // Remettre le véhicule disponible
            $mission->vehicle()->update(['available' => true]);
        }

        // Si annulée, remettre le véhicule disponible
        if ($validated['status'] === 'cancelled') {
            $mission->vehicle()->update(['available' => true]);
        }

        $mission->update($data);

        return redirect()
            ->route('transporteur.missions.show', $mission)
            ->with('success', 'Statut de la mission mis à jour.');
    }
}
