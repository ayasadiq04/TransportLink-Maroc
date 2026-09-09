<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTransportRequestRequest;
use App\Http\Requests\UpdateTransportRequestRequest;
use App\Models\TransportRequest;
use Illuminate\Http\Request;

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
     * Transporteur — demandes disponibles (status pending) avec filtres.
     */
    public function availableForTransporteur(Request $request)
    {
        $query = TransportRequest::where('status', 'pending')
            ->with('client')
            ->withCount('offers');

        // Filtre départ (accepte 'departure' ou 'departure_city')
        $departure = $request->input('departure', $request->input('departure_city'));
        if (!empty($departure)) {
            $query->where('departure_city', 'like', '%' . trim($departure) . '%');
        }

        // Filtre arrivée (accepte 'arrival' ou 'destination_city')
        $arrival = $request->input('arrival', $request->input('destination_city'));
        if (!empty($arrival)) {
            $query->where('destination_city', 'like', '%' . trim($arrival) . '%');
        }

        // Filtre marchandise (accepte 'cargo' ou 'goods_type')
        $cargo = $request->input('cargo', $request->input('goods_type'));
        if (!empty($cargo)) {
            $query->where(function ($q) use ($cargo) {
                $q->where('goods_type', 'like', '%' . trim($cargo) . '%')
                  ->orWhere('title', 'like', '%' . trim($cargo) . '%');
            });
        }

        $requests = $query->latest()->get();

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
<<<<<<< HEAD
        $validated = $request->validated();
=======
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

>>>>>>> 230d605c40ca0950958722dca40f541066fdc464
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
        $this->authorize('view', $transportRequest);

        $transportRequest->load(['offers.transporteur', 'offers.vehicle', 'mission']);

        return view('client.transport-requests.show', compact('transportRequest'));
    }

    /**
     * Transporteur — detail d'une demande disponible ou liée à ses offres/missions.
     */
    public function showForTransporteur(TransportRequest $transportRequest)
    {
<<<<<<< HEAD
        $this->authorize('view', $transportRequest);
=======
        // Un transporteur peut voir la demande si elle est disponible (pending),
        // OU s'il a déjà soumis une offre pour cette demande,
        // OU s'il est le transporteur assigné à la mission associée.
        $hasOffer = $transportRequest->offers()
            ->where('transporteur_id', auth()->id())
            ->exists();
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464

        $isAssignedMission = $transportRequest->mission()
            ->where('transporteur_id', auth()->id())
            ->exists();

<<<<<<< HEAD
=======
        if ($transportRequest->status !== 'pending' && !$hasOffer && !$isAssignedMission) {
            abort(404);
        }

        $transportRequest->load(['client', 'offers.transporteur', 'offers.vehicle', 'mission']);

        // Récupérer l'offre de ce transporteur sur cette demande
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464
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
<<<<<<< HEAD
        $this->authorize('update', $transportRequest);
=======
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('client.transport-requests.show', $transportRequest)
                ->with('error', 'Cette demande ne peut plus être modifiée.');
        }
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464

        return view('client.transport-requests.edit', compact('transportRequest'));
    }

    /**
     * Client — mettre a jour une demande.
     */
    public function update(UpdateTransportRequestRequest $request, TransportRequest $transportRequest)
    {
<<<<<<< HEAD
        $transportRequest->update($request->validated());
=======
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
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464

        return redirect()
            ->route('client.transport-requests.index')
            ->with('success', 'Demande modifiée avec succès.');
    }

    /**
     * Client — supprimer une demande.
     */
    public function destroy(TransportRequest $transportRequest)
    {
<<<<<<< HEAD
        $this->authorize('delete', $transportRequest);
=======
        abort_unless($transportRequest->client_id === auth()->id(), 403);

        if ($transportRequest->status !== 'pending') {
            return redirect()
                ->route('client.transport-requests.index')
                ->with('error', 'Cette demande ne peut plus être supprimée.');
        }
>>>>>>> 230d605c40ca0950958722dca40f541066fdc464

        $transportRequest->delete();

        return redirect()
            ->route('client.transport-requests.index')
            ->with('success', 'Demande supprimée avec succès.');
    }
}