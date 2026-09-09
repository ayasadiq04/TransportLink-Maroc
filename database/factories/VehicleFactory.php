<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Vehicle>
 */
class VehicleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'transporteur_id'    => User::factory(),
            'type'               => fake()->randomElement(['camion', 'fourgon', 'semi-remorque', 'utilitaire']),
            'brand'              => fake()->randomElement(['Renault', 'Mercedes', 'Volvo', 'Iveco', 'MAN']),
            'model'              => fake()->bothify('Model-##'),
            'registration_number' => strtoupper(substr(fake()->bothify('####-##-??'), 0, 9)),
            'capacity'           => fake()->randomElement([1, 2, 3.5, 7.5, 10, 20, 25, 30]),
            'available'          => true,
        ];
    }
}