<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\TransportRequest>
 */
class TransportRequestFactory extends Factory
{
    public function definition(): array
    {
        $cities = ['Casablanca', 'Rabat', 'Marrakech', 'Fès', 'Tanger', 'Agadir', 'Meknès', 'Oujda', 'El Jadida', 'Tétouan'];

        return [
            'client_id'          => User::factory(),
            'title'              => ucfirst(fake()->words(3, true)),
            'departure_city'     => fake()->randomElement($cities),
            'departure_address'  => fake()->streetAddress(),
            'destination_city'   => fake()->randomElement($cities),
            'destination_address'=> fake()->streetAddress(),
            'pickup_at'          => now()->addDays(fake()->numberBetween(1, 14)),
            'goods_type'         => fake()->randomElement(['palette', 'vrac', 'frigorifique', 'liquide', 'colis_volumineux', 'autre']),
            'weight'             => fake()->randomElement([100, 250, 500, 1000, 2000, 5000]),
            'volume'             => fake()->randomElement([1, 2, 5, 10, 20]),
            'instructions'       => fake()->optional()->sentence(),
            'estimated_budget'   => fake()->randomElement([500, 1000, 1500, 2500, 5000, 8000]),
            'status'             => 'pending',
        ];
    }
}