<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Services\MissionStatusService;
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
            ->with(['transportRequest', 'transporteur', 'vehicle'])
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

        $mission->load(['transportRequest', 'transporteur', 'vehicle', 'offer']);

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

        $result = app(MissionStatusService::class)->transition($mission, $validated['status']);

        if ($result['error']) {
            return back()->with('error', $result['error']);
        }

        return redirect()
            ->route('transporteur.missions.show', $mission)
            ->with('success', $result['changed'] ? 'Statut de la mission mis à jour avec succès.' : 'Statut inchangé.');
    }
}
