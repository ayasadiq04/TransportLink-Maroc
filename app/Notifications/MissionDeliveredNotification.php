<?php

namespace App\Notifications;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MissionDeliveredNotification extends Notification
{
    use Queueable;

    public Mission $mission;

    public function __construct(Mission $mission)
    {
        $this->mission = $mission;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Votre livraison est terminée')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('La mission effectuée par ' . ($this->mission->transporteur?->name ?? 'le transporteur') . ' a été livrée avec succès.')
            ->line('Nous vous invitons à laisser une évaluation sur la qualité de la prestation.')
            ->action('Évaluer le transporteur', route('client.missions.index'))
            ->line('Merci d\'utiliser TransportLink Maroc !');
    }
}