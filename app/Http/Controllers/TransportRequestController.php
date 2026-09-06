<?php

namespace App\Http\Controllers;

use App\Models\TransportRequest;
use Illuminate\Http\Request;

class TransportRequestController extends Controller
{
    /**
     * Client — liste de ses demandes.
     */
    public function index()
    {
        $requests = TransportRequest::where('client_id', auth()->id())
            ->withCount('offers')
            ->latest()
            ->get();

        return view('transport-requests.index', compact('requests'));
    }

    /**
     * Transporteur — demandes disponibles (status pending).
     */
    public function availableForTransporteur()
    {
        $requests = TransportRequest::where('status', 'pending')
            ->with('client')
            ->withCount('offers')
            ->latest()
            ->get();

        return view('transporteur.requests.index', compact('requests'));
    }

    /**
     * Client — formulaire de création.
     */
    public function create()
    {
        return view('transport-requests.create');
    }

    /**
     * Client — enregistrer une nouvelle demande.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:255',
            'departure_city'      => 'required|string|max:255',
            'departure_address'   => 'required|string|max:255',
            'destination_city'    => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'pickup_at'           => 'required|date',
            'goods_type'          => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight'              => 'nullable|numeric|min:0',
            'volume'              => 'nullable|numeric|min:0',
            'instructions'        => 'nullable|string',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ]);

        $validated['client_id'] = auth()->id();

        TransportRequest::create($validated);

        return redirect()
            ->route('transport-requests.index')
            ->with('success', 'Demande créée avec succès. Les transporteurs peuvent maintenant proposer des offres.');
    }

    /**
     * Client — détail d'une demande.
     */
    public function show(TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        $transportRequest->load(['offers.transporteur', 'offers.vehicle', 'mission']);

        return view('transport-requests.show', compact('transportRequest'));
    }

    /**
     * Transporteur — détail d'une demande disponible.
     */
    public function showForTransporteur(TransportRequest $transportRequest)
    {
        abort_if($transportRequest->status !== 'pending', 404);

        $transportRequest->load(['client', 'offers']);

        // Vérifier si le transporteur a déjà une offre sur cette demande
        $myOffer = $transportRequest->offers()
            ->where('transporteur_id', auth()->id())
            ->first();

        return view('transporteur.requests.show', compact('transportRequest', 'myOffer'));
    }

    /**
     * Client — formulaire de modification.
     */
    public function edit(TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        // On ne peut modifier qu'une demande en attente
        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('transport-requests.show', $transportRequest)
                ->with('error', 'Cette demande ne peut plus être modifiée.');
        }

        return view('transport-requests.edit', compact('transportRequest'));
    }

    /**
     * Client — mettre à jour une demande.
     */
    public function update(Request $request, TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('transport-requests.show', $transportRequest)
                ->with('error', 'Cette demande ne peut plus être modifiée.');
        }

        $validated = $request->validate([
            'title'               => 'required|string|max:255',
            'departure_city'      => 'required|string|max:255',
            'departure_address'   => 'required|string|max:255',
            'destination_city'    => 'required|string|max:255',
            'destination_address' => 'required|string|max:255',
            'pickup_at'           => 'required|date',
            'goods_type'          => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight'              => 'nullable|numeric|min:0',
            'volume'              => 'nullable|numeric|min:0',
            'instructions'        => 'nullable|string',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ]);

        $transportRequest->update($validated);

        return redirect()
            ->route('transport-requests.index')
            ->with('success', 'Demande modifiée avec succès.');
    }

    /**
     * Client — supprimer une demande.
     */
    public function destroy(TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('transport-requests.index')
                ->with('error', 'Cette demande ne peut plus être supprimée.');
        }

        $transportRequest->delete();

        return redirect()
            ->route('transport-requests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}