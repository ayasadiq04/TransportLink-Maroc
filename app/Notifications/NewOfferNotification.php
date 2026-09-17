<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewOfferNotification extends Notification
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
        return [
            'title'      => 'Nouvelle offre reçue',
            'message'    => 'Un transporteur a proposé une offre pour votre demande.',
            'type'       => 'new_offer',
            'url'        => route('client.offers.index'),
            'related_id' => $this->offer->id,
        ];
    }
}