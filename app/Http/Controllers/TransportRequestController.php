<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportRequestRequest;
use App\Http\Requests\UpdateTransportRequestRequest;
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
    public function store(StoreTransportRequestRequest $request)
    {
        $validated = $request->validated();
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
        $this->authorize('view', $transportRequest);

        $transportRequest->load(['offers.transporteur', 'offers.vehicle', 'mission']);

        return view('client.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Transporteur — détail d'une demande disponible.
     */
    public function showForTransporteur(TransportRequest $transportRequest)
    {
        $this->authorize('view', $transportRequest);

        $transportRequest->load(['client', 'offers']);

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
        $this->authorize('update', $transportRequest);

        return view('transport-requests.edit', compact('transportRequest'));
    }

    /**
     * Client — mettre à jour une demande.
     */
    public function update(UpdateTransportRequestRequest $request, TransportRequest $transportRequest)
    {
        $transportRequest->update($request->validated());

        return redirect()
            ->route('transport-requests.index')
            ->with('success', 'Demande modifiée avec succès.');
    }

    /**
     * Client — supprimer une demande.
     */
    public function destroy(TransportRequest $transportRequest)
    {
        $this->authorize('delete', $transportRequest);

        $transportRequest->delete();

        return redirect()
            ->route('transport-requests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}