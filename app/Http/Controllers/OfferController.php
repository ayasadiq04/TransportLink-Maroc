<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfferController extends Controller
{
    /**
     * Afficher le formulaire pour proposer une offre.
     */
    public function create(TransportRequest $transportRequest)
    {
        $vehicles = Vehicle::where('transporteur_id', Auth::id())
            ->where('available', true)
            ->get();

        return view('offers.create', compact(
            'transportRequest',
            'vehicles'
        ));
    }

    /**
     * Enregistrer une nouvelle offre.
     */
    public function store(Request $request, TransportRequest $transportRequest)
    {
        $validated = $request->validate([
            'vehicle_id' => [
                'required',
                'exists:vehicles,id',
            ],
            'price' => [
                'required',
                'numeric',
                'min:0',
            ],
            'message' => [
                'nullable',
                'string',
                'max:1000',
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
            'transport_request_id' => $transportRequest->id,
            'transporteur_id' => Auth::id(),
            'vehicle_id' => $vehicle->id,
            'price' => $validated['price'],
            'message' => $validated['message'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()
            ->route('transport-requests.index')
            ->with(
                'success',
                'Votre offre a été proposée avec succès.'
            );
    }
}