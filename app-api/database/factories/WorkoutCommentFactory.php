<?php

namespace Database\Factories;

use App\Models\Workout;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class WorkoutCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // return [
        //     'user_id' => User::factory(),
        //     'workout_id' => Workout::factory(),
        //     'comment' => $this->faker->paragraph,
        // ];
        return [
            'user_id' => User::factory(),
            // Use a specific workout_id instead of Workout::factory()
            'workout_id' => function () {
                return Workout::factory()->create()->id;
            },
            'comment' => $this->faker->paragraph,
        ];
    }
}
