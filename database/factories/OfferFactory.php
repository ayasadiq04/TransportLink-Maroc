<?php

namespace Database\Factories;

use App\Models\TransportRequest;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Offer>
 */
class OfferFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transport_request_id'    => TransportRequest::factory(),
            'transporteur_id'         => User::factory(),
            'vehicle_id'              => Vehicle::factory(),
            'amount'                  => fake()->randomElement([800, 1200, 1800, 2500, 3500]),
            'message'                 => fake()->optional()->sentence(),
            'conditions'              => fake()->optional()->sentence(),
            'estimated_delivery_time' => fake()->optional()->randomElement(['24h', '48h', '3 jours', '1 semaine']),
            'status'                  => 'pending',
        ];
    }
}