<?php

namespace App\Http\Controllers;

use App\Notifications\MissionDeliveredNotification;
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
        $this->authorize('view', $mission);

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
        $this->authorize('view', $mission);

        $mission->load(['transportRequest', 'client', 'vehicle', 'offer']);

        return view('transporteur.missions.show', compact('mission'));
    }

    /**
     * Transporteur — mettre à jour le statut d'une mission.
     */
    public function updateStatus(Request $request, Mission $mission)
    {
        $this->authorize('updateStatus', $mission);

        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,in_delivery,delivered,cancelled',
        ], [
            'status.required' => 'Le statut est obligatoire.',
            'status.in'       => 'Statut invalide sélectionné.',
        ]);

        $allowedTransitions = [
            'pending'     => ['accepted', 'in_delivery', 'cancelled'],
            'accepted'    => ['in_delivery', 'cancelled'],
            'in_delivery' => ['delivered', 'cancelled'],
        ];

        $currentStatus = $mission->status;
        $targetStatus  = $validated['status'];

        // Si le statut ne change pas, retourner simplement avec succès
        if ($currentStatus === $targetStatus) {
            return redirect()
                ->route('transporteur.missions.show', $mission)
                ->with('success', 'Statut inchangé.');
        }

        if (!isset($allowedTransitions[$currentStatus]) ||
            !in_array($targetStatus, $allowedTransitions[$currentStatus])) {
            return back()->with('error', 'Transition de statut non autorisée pour cette mission.');
        }

        $data = ['status' => $targetStatus];

        // Si livrée, enregistrer la date de livraison, synchroniser la demande et libérer le véhicule
        if ($targetStatus === 'delivered') {
            $data['delivered_at'] = now();

            // Mettre à jour la demande en 'completed'
            $mission->transportRequest()->update(['status' => 'completed']);

            // Remettre le véhicule disponible
            if ($mission->vehicle_id) {
                $mission->vehicle()->update(['available' => true]);
            }

            // Notifier le client de la livraison
            $mission->client->notify(new MissionDeliveredNotification($mission));
        }

        // Si annulée, remettre le véhicule disponible et la demande en 'cancelled'
        if ($targetStatus === 'cancelled') {
            $mission->transportRequest()->update(['status' => 'cancelled']);

            if ($mission->vehicle_id) {
                $mission->vehicle()->update(['available' => true]);
            }
        }

        $mission->update($data);

        return redirect()
            ->route('transporteur.missions.show', $mission)
            ->with('success', 'Statut de la mission mis à jour avec succès.');
    }
}
