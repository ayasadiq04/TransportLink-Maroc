<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfferRequest;
use App\Models\Mission;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\Vehicle;
use App\Notifications\NewOfferNotification;
use App\Notifications\OfferAcceptedNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Transporteur — liste de ses offres.
     */
    public function index()
    {
        $offers = Offer::where('transporteur_id', Auth::id())
            ->with(['transportRequest', 'vehicle'])
            ->latest()
            ->get();

        return view('transporteur.offers.index', compact('offers'));
    }

    /**
     * Transporteur — détail d'une offre.
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
        abort_if($transportRequest->status !== 'pending', 404);

        $vehicles = Vehicle::where('transporteur_id', Auth::id())
            ->where('available', true)
            ->get();

        return view('offers.create', compact(
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
            ->route('transporteur.requests.index')
            ->with('success', 'Votre offre a été proposée avec succès.');
    }

    /**
     * Client — voir les offres reçues sur ses demandes.
     */
    public function clientOffers()
    {
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
     */
    public function accept(Offer $offer)
    {
        $this->authorize('accept', $offer);

        $transportRequest = $offer->transportRequest;

        DB::transaction(function () use ($offer, $transportRequest) {
            $offer->update(['status' => 'accepted']);

            Offer::where('transport_request_id', $transportRequest->id)
                ->where('id', '!=', $offer->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            $transportRequest->update(['status' => 'accepted']);

            $mission = Mission::create([
                'transport_request_id' => $transportRequest->id,
                'offer_id'             => $offer->id,
                'client_id'            => $transportRequest->client_id,
                'transporteur_id'      => $offer->transporteur_id,
                'vehicle_id'           => $offer->vehicle_id,
                'status'               => 'pending',
                'planned_at'           => $transportRequest->pickup_at,
            ]);

            $offer->vehicle()->update(['available' => false]);

            $offer->transporteur->notify(new OfferAcceptedNotification($offer));
        });

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

        return back()->with('success', 'Offre rejetée.');
    }
}