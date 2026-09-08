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

        return view('client.transport-requests.index', compact('requests'));
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
     * Client — formulaire de creation.
     */
    public function create()
    {
        return view('client.transport-requests.create');
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
            'pickup_at'           => 'required|date|after:now',
            'goods_type'          => 'required|in:palette,vrac,frigorifique,liquide,colis_volumineux,autre',
            'weight'              => 'nullable|numeric|min:0',
            'volume'              => 'nullable|numeric|min:0',
            'instructions'        => 'nullable|string|max:2000',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ], [
            'title.required'            => 'Le titre est obligatoire.',
            'departure_city.required'   => 'La ville de départ est obligatoire.',
            'destination_city.required' => 'La ville de destination est obligatoire.',
            'pickup_at.required'        => 'La date d\'enlèvement est obligatoire.',
            'pickup_at.after'           => 'La date d\'enlèvement doit être dans le futur.',
            'goods_type.required'       => 'Le type de marchandise est obligatoire.',
            'goods_type.in'             => 'Type de marchandise invalide.',
        ]);

        $validated['client_id'] = auth()->id();
        $validated['status']    = 'pending';

        TransportRequest::create($validated);

        return redirect()
            ->route('client.transport-requests.index')
            ->with('success', 'Demande créée avec succès. Les transporteurs peuvent maintenant proposer des offres.');
    }

    /**
     * Client — detail d'une demande.
     */
    public function show(TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        $transportRequest->load(['offers.transporteur', 'offers.vehicle', 'mission']);

        return view('client.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Transporteur — detail d'une demande disponible.
     */
    public function showForTransporteur(TransportRequest $transportRequest)
    {
        abort_if($transportRequest->status !== 'pending', 404);

        $transportRequest->load(['client', 'offers']);

        // Verifier si le transporteur a deja une offre sur cette demande
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

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('client.transport-requests.show', $transportRequest)
                ->with('error', 'Cette demande ne peut plus être modifiée.');
        }

        return view('client.transport-requests.edit', compact('transportRequest'));
    }

    /**
     * Client — mettre a jour une demande.
     */
    public function update(Request $request, TransportRequest $transportRequest)
    {
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('client.transport-requests.show', $transportRequest)
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
            'instructions'        => 'nullable|string|max:2000',
            'estimated_budget'    => 'nullable|numeric|min:0',
        ]);

        $transportRequest->update($validated);

        return redirect()
            ->route('client.transport-requests.index')
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
                ->route('client.transport-requests.index')
                ->with('error', 'Cette demande ne peut plus être supprimée.');
        }

        $transportRequest->delete();

        return redirect()
            ->route('client.transport-requests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}