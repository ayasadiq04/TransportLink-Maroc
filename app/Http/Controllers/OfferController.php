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
     * Transporteur — détail d'une offre.
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
        // La demande doit encore être disponible
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
        ]);

        // Vérifier que le véhicule appartient au transporteur connecté
        $vehicle = Vehicle::where('id', $validated['vehicle_id'])
            ->where('transporteur_id', Auth::id())
            ->where('available', true)
            ->firstOrFail();

        // Vérifier si le transporteur a déjà proposé une offre
        $alreadyExists = Offer::where('transport_request_id', $transportRequest->id)
            ->where('transporteur_id', Auth::id())
            ->exists();

        if ($alreadyExists) {
            return back()->with(
                'error',
                'Vous avez déjà proposé une offre pour cette demande.'
            );
        }

        Offer::create([
            'transport_request_id'  => $transportRequest->id,
            'transporteur_id'       => Auth::id(),
            'vehicle_id'            => $vehicle->id,
            'amount'                => $validated['amount'],
            'message'               => $validated['message'] ?? null,
            'conditions'            => $validated['conditions'] ?? null,
            'estimated_delivery_time' => $validated['estimated_delivery_time'] ?? null,
            'status'                => 'pending',
        ]);

        return redirect()
            ->route('transporteur.requests.index')
            ->with('success', 'Votre offre a été proposée avec succès.');
    }

    /**
     * Client — voir les offres reçues sur ses demandes.
     */
    public function clientOffers()
    {
        // Récupérer toutes les offres sur les demandes du client connecté
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
     * Crée automatiquement une mission.
     */
    public function accept(Offer $offer)
    {
        $transportRequest = $offer->transportRequest;

        // Vérifier que c'est le client de cette demande
        abort_unless($transportRequest->client_id === Auth::id(), 403);

        // Vérifier que la demande est encore en attente
        if ($transportRequest->status !== 'pending') {
            return back()->with('error', 'Cette demande n\'est plus en attente.');
        }

        // Vérifier que l'offre est encore en attente
        if ($offer->status !== 'pending') {
            return back()->with('error', 'Cette offre n\'est plus disponible.');
        }

        // Transaction pour garantir la cohérence
        DB::transaction(function () use ($offer, $transportRequest) {
            // 1. Accepter l'offre sélectionnée
            $offer->update(['status' => 'accepted']);

            // 2. Rejeter toutes les autres offres en attente
            Offer::where('transport_request_id', $transportRequest->id)
                ->where('id', '!=', $offer->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            // 3. Mettre à jour le statut de la demande
            $transportRequest->update(['status' => 'accepted']);

            // 4. Créer la mission automatiquement
            Mission::create([
                'transport_request_id' => $transportRequest->id,
                'offer_id'             => $offer->id,
                'client_id'            => $transportRequest->client_id,
                'transporteur_id'      => $offer->transporteur_id,
                'vehicle_id'           => $offer->vehicle_id,
                'status'               => 'pending',
                'planned_at'           => $transportRequest->pickup_at,
            ]);

            // 5. Rendre le véhicule indisponible
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