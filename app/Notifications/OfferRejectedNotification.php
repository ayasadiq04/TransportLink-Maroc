<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OfferRejectedNotification extends Notification
{
    use Queueable;

    public Offer $offer;

    public function __construct(Offer $offer)
    {
        $this->offer = $offer;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        $request = $this->offer->transportRequest;
        $label = $request ? $request->departure_city . ' → ' . $request->destination_city : (string) $this->offer->id;

        return [
            'title'      => 'Offre refusée',
            'message'    => 'Votre offre pour la demande ' . $label . ' a été refusée.',
            'type'       => 'offer_rejected',
            'url'        => route('transporteur.offers.show', $this->offer),
            'related_id' => $this->offer->id,
        ];
    }
}