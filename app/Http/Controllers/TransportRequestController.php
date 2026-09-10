<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportRequestRequest;
use App\Http\Requests\UpdateTransportRequestRequest;
use App\Models\TransportRequest;
use App\Models\User;
use App\Notifications\NewTransportRequestNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class TransportRequestController extends Controller
{
    /**
     * Client — liste de ses demandes avec filtres.
     */
    public function index(Request $request)
    {
        $query = TransportRequest::where('client_id', auth()->id())
            ->withCount('offers');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('departure_city')) {
            $query->where('departure_city', 'like', '%' . $request->departure_city . '%');
        }

        if ($request->filled('destination_city')) {
            $query->where('destination_city', 'like', '%' . $request->destination_city . '%');
        }

        if ($request->filled('goods_type')) {
            $query->where('goods_type', $request->goods_type);
        }

        $requests = $query->latest()->get();

        return view('client.transport-requests.index', compact('requests'));
    }

    /**
     * Transporteur — demandes disponibles (status pending).
     */
    public function availableForTransporteur()
    {
        $requests = TransportRequest::where('status', 'pending')
            ->withCount('offers')
            ->latest()
            ->paginate(9);

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
    public function store(StoreTransportRequestRequest $request)
    {
        $validated = $request->validated();

        $validated['client_id'] = auth()->id();
        $validated['status']    = 'pending';

        $transportRequest = TransportRequest::create($validated);

        // Notifier tous les transporteurs d'une nouvelle demande disponible
        $transporteurs = User::where('role', 'transporteur')->get();
        Notification::send($transporteurs, new NewTransportRequestNotification($transportRequest));

        return redirect()
            ->route('client.transport-requests.index')
            ->with('success', 'Demande créée avec succès. Les transporteurs peuvent maintenant proposer des offres.');
    }

    /**
     * Client — detail d'une demande.
     */
    public function show(TransportRequest $transportRequest)
    {
        $this->authorize('view', $transportRequest);

        $transportRequest->load(['offers.transporteur', 'offers.vehicle', 'mission']);

        return view('client.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Transporteur — detail d'une demande disponible ou liée à ses offres/missions.
     */
    public function showForTransporteur(TransportRequest $transportRequest)
    {
        $this->authorize('view', $transportRequest);

        $transportRequest->load(['client', 'offers.transporteur', 'offers.vehicle', 'mission']);

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

        return view('client.transport-requests.edit', compact('transportRequest'));
    }

    /**
     * Client — mettre a jour une demande.
     */
    public function update(UpdateTransportRequestRequest $request, TransportRequest $transportRequest)
    {
        $transportRequest->update($request->validated());

        return redirect()
            ->route('client.transport-requests.index')
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
            ->route('client.transport-requests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}