<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Support\NotificationChannels;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
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
        return NotificationChannels::available();
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

    public function toMail(object $notifiable): MailMessage
    {
        $transporteur = $this->offer->transporteur?->name ?? 'Un transporteur';

        return (new MailMessage)
            ->subject('Nouvelle offre reçue sur votre demande')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Un transporteur a proposé une offre sur votre demande de transport.')
            ->line($transporteur . ' propose un montant de ' . number_format($this->offer->amount, 2) . ' DH.')
            ->action('Voir les offres', route('client.offers.index'))
            ->line('Vous pouvez accepter ou refuser cette offre depuis votre tableau de bord.');
    }
}