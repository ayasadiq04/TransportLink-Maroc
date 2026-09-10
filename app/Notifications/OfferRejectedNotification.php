<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Support\NotificationChannels;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
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
        return NotificationChannels::available();
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

    public function toMail(object $notifiable): MailMessage
    {
        $request = $this->offer->transportRequest;
        $label = $request ? $request->departure_city . ' → ' . $request->destination_city : (string) $this->offer->id;

        return (new MailMessage)
            ->subject('Votre offre a été refusée')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Votre offre pour la demande ' . $label . ' a été refusée par le client.')
            ->line('Vous pouvez consulter vos autres offres et propositions en cours.')
            ->action('Voir mon offre', route('transporteur.offers.show', $this->offer));
    }
}