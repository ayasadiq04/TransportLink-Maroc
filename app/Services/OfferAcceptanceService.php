<?php

namespace App\Services;

use App\Models\Offer;
use App\Notifications\OfferAcceptedNotification;
use Illuminate\Support\Facades\DB;

class OfferAcceptanceService
{
    /**
     * Accepte une offre et crée la mission associée dans une transaction.
     * Préconditions (autorisation, statuts) vérifiées par le contrôleur.
     */
    public function accept(Offer $offer): Offer
    {
        $transportRequest = $offer->transportRequest;

        DB::transaction(function () use ($offer, $transportRequest) {
            // 1. Accepter l'offre sélectionnée
            $offer->update(['status' => 'accepted']);

            // 2. Rejeter les autres offres en attente sur la même demande
            $offer->where('transport_request_id', $transportRequest->id)
                ->where('id', '!=', $offer->id)
                ->where('status', 'pending')
                ->update(['status' => 'rejected']);

            // 3. Mettre à jour le statut de la demande
            $transportRequest->update(['status' => 'accepted']);

            // 4. Créer la mission automatiquement
            $transportRequest->mission()->create([
                'offer_id'        => $offer->id,
                'client_id'       => $transportRequest->client_id,
                'transporteur_id' => $offer->transporteur_id,
                'vehicle_id'      => $offer->vehicle_id,
                'status'          => 'pending',
                'planned_at'      => $transportRequest->pickup_at,
            ]);

            // 5. Rendre le véhicule indisponible
            $offer->vehicle()->update(['available' => false]);

            // 6. Notifier le transporteur
            $offer->transporteur->notify(new OfferAcceptedNotification($offer));
        });

        return $offer->fresh();
    }
}