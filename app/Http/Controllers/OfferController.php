<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\Vehicle;
use App\Notifications\NewOfferNotification;
use App\Notifications\OfferRejectedNotification;
use App\Services\OfferAcceptanceService;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Transporteur — liste de ses offres.
     */
    public function index()
    {
        $offers = Offer::where('transporteur_id', Auth::id())
            ->with(['transportRequest.client', 'vehicle'])
            ->latest()
            ->get();

        return view('transporteur.offers.index', compact('offers'));
    }

    /**
     * Transporteur — detail d'une offre.
     */
    public function show(Offer $offer)
    {
        $this->authorize('view', $offer);

        $offer->load(['transportRequest', 'vehicle', 'mission']);

        return view('transporteur.offers.show', compact('offer'));
    }

    /**
     * Transporteur — formulaire pour proposer une offre.
     */
    public function create(TransportRequest $transportRequest)
    {
        // La demande doit encore etre disponible
        abort_if($transportRequest->status !== 'pending', 404);

        // Verifier si le transporteur a deja une offre sur cette demande
        $alreadyExists = Offer::where('transport_request_id', $transportRequest->id)
            ->where('transporteur_id', Auth::id())
            ->exists();

        if ($alreadyExists) {
            return redirect()
                ->route('transporteur.requests.show', $transportRequest)
                ->with('error', 'Vous avez déjà proposé une offre pour cette demande.');
        }

        $vehicles = Vehicle::where('transporteur_id', Auth::id())
            ->where('available', true)
            ->get();

        return view('transporteur.offers.create', compact(
            'transportRequest',
            'vehicles'
        ));
    }

    /**
     * Transporteur — enregistrer une nouvelle offre.
     */
    public function store(StoreOfferRequest $request, TransportRequest $transportRequest)
    {
        $validated = $request->validated();

        $offer = Offer::create([
            'transport_request_id'    => $transportRequest->id,
            'transporteur_id'         => Auth::id(),
            'vehicle_id'              => $validated['vehicle_id'],
            'amount'                  => $validated['amount'],
            'message'                 => $validated['message'] ?? null,
            'conditions'              => $validated['conditions'] ?? null,
            'estimated_delivery_time' => $validated['estimated_delivery_time'] ?? null,
            'status'                  => 'pending',
        ]);

        $transportRequest->client->notify(new NewOfferNotification($offer));

        return redirect()
            ->route('transporteur.offers.index')
            ->with('success', 'Votre offre a été proposée avec succès.');
    }

    /**
     * Client — voir les offres recues sur ses demandes.
     */
    public function clientOffers()
    {
        // Recuperer toutes les offres sur les demandes du client connecte
        $offers = Offer::whereHas('transportRequest', function ($query) {
                $query->where('client_id', Auth::id());
            })
            ->with(['transportRequest', 'transporteur', 'vehicle'])
            ->latest()
            ->get();

        return view('client.offers.index', compact('offers'));
    }

    /**
     * Client — accepter une offre.
     * Cree automatiquement une mission.
     */
    public function accept(Offer $offer)
    {
        $this->authorize('accept', $offer);

        $transportRequest = $offer->transportRequest;

        // Verifier que c'est le client de cette demande
        abort_unless($transportRequest->client_id === Auth::id(), 403);

        // Verifier que la demande est encore en attente
        if ($transportRequest->status !== 'pending') {
            return back()->with('error', 'Cette demande n\'est plus en attente.');
        }

        // Verifier que l'offre est encore en attente
        if ($offer->status !== 'pending') {
            return back()->with('error', 'Cette offre n\'est plus disponible.');
        }

        app(OfferAcceptanceService::class)->accept($offer);

        return redirect()
            ->route('client.missions.index')
            ->with('success', 'Offre acceptée ! Une mission a été créée.');
    }

    /**
     * Client — rejeter une offre.
     */
    public function reject(Offer $offer)
    {
        $this->authorize('reject', $offer);

        $offer->update(['status' => 'rejected']);

        // Notifier le transporteur propriétaire de l'offre
        $offer->transporteur->notify(new OfferRejectedNotification($offer));

        return back()->with('success', 'Offre rejetée.');
    }
}