<?php

namespace App\Notifications;

use App\Models\Mission;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class MissionStatusUpdatedNotification extends Notification
{
    use Queueable;

    public Mission $mission;

    public string $status;

    public function __construct(Mission $mission, string $status)
    {
        $this->mission = $mission;
        $this->status = $status;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        [$title, $message] = $this->content();

        return [
            'title'      => $title,
            'message'    => $message,
            'type'       => 'mission_status',
            'url'        => route('client.missions.show', $this->mission),
            'related_id' => $this->mission->id,
        ];
    }

    /**
     * @return array{0: string, 1: string} [titre, message]
     */
    private function content(): array
    {
        return match ($this->status) {
            'accepted'    => ['Mission acceptée', 'Votre mission a été acceptée.'],
            'in_delivery' => ['Livraison en cours', 'Votre livraison est maintenant en cours.'],
            'delivered'   => ['Livraison effectuée', 'Votre livraison a été effectuée avec succès.'],
            'cancelled'   => ['Mission annulée', 'Votre mission a été annulée.'],
            default       => ['Statut de mission mis à jour', 'Le statut de votre mission a été mis à jour.'],
        };
    }
}