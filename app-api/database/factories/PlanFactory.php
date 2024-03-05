<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'name' => $this->faker->name,
            // 'price' => $this->faker->numberBetween(10, 1000),
            // 'duration_months' => $this->faker->randomNumber,
            'name' => 'Simeple workout plan',
            'price' => '600',
            'duration_months' => '6'

        ];
    }
}
