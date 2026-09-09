<?php

namespace Database\Factories;

use App\Models\Mission;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    public function definition(): array
    {
        return [
            'mission_id'      => Mission::factory(),
            'client_id'       => User::factory(),
            'transporteur_id' => User::factory(),
            'rating'          => fake()->numberBetween(1, 5),
            'comment'         => fake()->optional()->paragraph(),
        ];
    }
}