<?php

namespace App\Services;

use App\Models\Mission;
use App\Notifications\MissionDeliveredNotification;

class MissionStatusService
{
    /**
     * Transitions de statut autorisées pour une mission.
     */
    private const ALLOWED_TRANSITIONS = [
        'pending'     => ['accepted', 'in_delivery', 'cancelled'],
        'accepted'    => ['in_delivery', 'cancelled'],
        'in_delivery' => ['delivered', 'cancelled'],
    ];

    /**
     * Applique la transition de statut et ses effets de bord (véhicule, demande, notification).
     *
     * @return array{changed: bool, error: string|null} Resultat de la transition
     */
    public function transition(Mission $mission, string $targetStatus): array
    {
        $currentStatus = $mission->status;

        if ($currentStatus === $targetStatus) {
            return ['changed' => false, 'error' => null];
        }

        if (!isset(self::ALLOWED_TRANSITIONS[$currentStatus]) ||
            !in_array($targetStatus, self::ALLOWED_TRANSITIONS[$currentStatus], true)) {
            return ['changed' => false, 'error' => 'Transition de statut non autorisée pour cette mission.'];
        }

        $data = ['status' => $targetStatus];

        // Si livrée : date de livraison + demande 'completed' + véhicule libéré + notification
        if ($targetStatus === 'delivered') {
            $data['delivered_at'] = now();
            $mission->transportRequest()->update(['status' => 'completed']);

            if ($mission->vehicle_id) {
                $mission->vehicle()->update(['available' => true]);
            }

            $mission->client->notify(new MissionDeliveredNotification($mission));
        }

        // Si annulée : demande 'cancelled' + véhicule libéré
        if ($targetStatus === 'cancelled') {
            $mission->transportRequest()->update(['status' => 'cancelled']);

            if ($mission->vehicle_id) {
                $mission->vehicle()->update(['available' => true]);
            }
        }

        $mission->update($data);

        return ['changed' => true, 'error' => null];
    }
}