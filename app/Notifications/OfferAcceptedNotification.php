<?php

namespace App\Notifications;

use App\Models\Offer;
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
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $route = $this->offer->transportRequest?->route
            ?? ($this->offer->transportRequest ? $this->offer->transportRequest->departure_city . ' → ' . $this->offer->transportRequest->arrival_city : '');

        return (new MailMessage)
            ->subject('Votre offre a été acceptée !')
            ->greeting('Félicitations ' . $notifiable->name . ',')
            ->line('Votre offre de ' . number_format($this->offer->amount, 2) . ' DH pour le trajet ' . $route . ' a été acceptée par le client.')
            ->line('Une mission a été créée. Vous pouvez la suivre dans votre espace transporteur.')
            ->action('Voir mes missions', route('transporteur.missions.index'))
            ->line('Toutes les autres offres concernant cette demande ont été rejetées et votre véhicule a été réservé pour cette mission.');
    }
}