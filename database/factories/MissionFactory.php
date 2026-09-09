<?php

namespace Database\Factories;

use App\Models\Offer;
use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transport_request_id' => TransportRequest::factory(),
            'offer_id'             => Offer::factory(),
            'client_id'            => User::factory(),
            'transporteur_id'      => User::factory(),
            'vehicle_id'           => Vehicle::factory(),
            'status'               => 'pending',
            'planned_at'           => now()->addDays(1),
            'delivered_at'         => null,
        ];
    }
}