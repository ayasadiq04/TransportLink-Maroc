<?php

namespace App\Notifications;

use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OfferAcceptedNotification extends Notification
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
            'title'      => 'Votre offre a été acceptée',
            'message'    => 'Votre offre pour la demande '
                . self::requestLabel($this->offer)
                . ' a été acceptée. Une mission a été créée.',
            'type'       => 'offer_accepted',
            'url'        => self::acceptedUrl($this->offer),
            'related_id' => $this->offer->id,
        ];
    }

    private static function requestLabel(Offer $offer): string
    {
        $request = $offer->transportRequest;

        if (! $request) {
            return (string) $offer->id;
        }

        return $request->departure_city . ' → ' . $request->destination_city;
    }

    private static function acceptedUrl(Offer $offer): string
    {
        $mission = $offer->mission;

        if ($mission) {
            return route('transporteur.missions.show', $mission);
        }

        return route('transporteur.offers.show', $offer);
    }
}