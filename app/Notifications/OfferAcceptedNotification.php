<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Support\NotificationChannels;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
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
        return NotificationChannels::available();
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

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre offre a été acceptée !')
            ->greeting('Félicitations ' . $notifiable->name . ',')
            ->line('Votre offre de ' . number_format($this->offer->amount, 2) . ' DH pour le trajet ' . self::requestLabel($this->offer) . ' a été acceptée par le client.')
            ->line('Une mission a été créée. Vous pouvez la suivre dans votre espace transporteur.')
            ->action('Voir mes missions', self::acceptedUrl($this->offer))
            ->line('Toutes les autres offres concernant cette demande ont été rejetées et votre véhicule a été réservé pour cette mission.');
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