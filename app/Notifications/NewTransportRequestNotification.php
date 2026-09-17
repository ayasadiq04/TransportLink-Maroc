<?php

namespace App\Notifications;

use App\Models\TransportRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class NewTransportRequestNotification extends Notification
{
    use Queueable;

    public TransportRequest $transportRequest;

    public function __construct(TransportRequest $transportRequest)
    {
        $this->transportRequest = $transportRequest;
    }

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'title'      => 'Nouvelle demande de transport',
            'message'    => 'Une nouvelle demande est disponible : '
                . $this->transportRequest->departure_city
                . ' → '
                . $this->transportRequest->destination_city,
            'type'       => 'new_request',
            'url'        => route('transporteur.requests.show', $this->transportRequest),
            'related_id' => $this->transportRequest->id,
        ];
    }
}