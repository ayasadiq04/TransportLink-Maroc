<?php

namespace App\Http\Controllers;

use App\Models\Mission;
use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\Vehicle;
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
     * Transporteur — detail d'une offre.
     */
    public function show(Offer $offer)
    {
        abort_unless($offer->transporteur_id === Auth::id(), 403);

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
    public function store(
        Request $request,
        TransportRequest $transportRequest
    ) {
        if ($transportRequest->status !== 'pending') {
            return back()->with(
                'error',
                'Cette demande n\'est plus disponible.'
            );
        }

        // Verifier si le transporteur a deja propose une offre
        $alreadyExists = Offer::where('transport_request_id', $transportRequest->id)
            ->where('transporteur_id', Auth::id())
            ->exists();

        if ($alreadyExists) {
            return back()->with(
                'error',
                'Vous avez déjà proposé une offre pour cette demande.'
            );
        }

        $validated = $request->validate([
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
            ],
            'amount' => [
                'required',
                'numeric',
                'min:1',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'conditions' => [
                'nullable',
                'string',
                'max:1000',
            ],
            'estimated_delivery_time' => [
                'nullable',
                'string',
                'max:255',
            ],
        ], [
            'vehicle_id.required' => 'Veuillez sélectionner un véhicule.',
            'amount.required'     => 'Le montant est obligatoire.',
            'amount.numeric'      => 'Le montant doit être un nombre.',
            'amount.min'          => 'Le montant doit être supérieur à 0.',
        ]);

        // Verifier que le vehicule appartient au transporteur connecte
        $vehicle = Vehicle::where('id', $validated['vehicle_id'])
            ->where('transporteur_id', Auth::id())
            ->where('available', true)
            ->firstOrFail();

        Offer::create([
            'transport_request_id'    => $transportRequest->id,
            'transporteur_id'         => Auth::id(),
            'vehicle_id'              => $vehicle->id,
            'amount'                  => $validated['amount'],
            'message'                 => $validated['message'] ?? null,
            'conditions'              => $validated['conditions'] ?? null,
            'estimated_delivery_time' => $validated['estimated_delivery_time'] ?? null,
            'status'                  => 'pending',
        ]);

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

        // Transaction pour garantir la coherence
        DB::transaction(function () use ($offer, $transportRequest) {
            // 1. Accepter l'offre selectionnee
            $offer->update(['status' => 'accepted']);

            // 2. Rejeter toutes les autres offres en attente
            Offer::where('transport_request_id', $transportRequest->id)
                ->where('id', '!=', $offer->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            // 3. Mettre a jour le statut de la demande
            $transportRequest->update(['status' => 'accepted']);

            // 4. Creer la mission automatiquement
            Mission::create([
                'transport_request_id' => $transportRequest->id,
                'offer_id'             => $offer->id,
                'client_id'            => $transportRequest->client_id,
                'transporteur_id'      => $offer->transporteur_id,
                'vehicle_id'           => $offer->vehicle_id,
                'status'               => 'pending',
                'planned_at'           => $transportRequest->pickup_at,
            ]);

            // 5. Rendre le vehicule indisponible
            $offer->vehicle()->update(['available' => false]);
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
        $transportRequest = $offer->transportRequest;

        abort_unless($transportRequest->client_id === Auth::id(), 403);

        if ($offer->status !== 'pending') {
            return back()->with('error', 'Cette offre ne peut plus être rejetée.');
        }

        $offer->update(['status' => 'rejected']);

        return back()->with('success', 'Offre rejetée.');
    }
}