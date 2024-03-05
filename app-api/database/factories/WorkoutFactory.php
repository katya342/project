<?php

namespace Database\Factories;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Workout>
 */
class WorkoutFactory extends Factory
{
   
    protected $model = \App\Models\Workout::class;

    public function definition()
    {
    
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->text,
            'date' => $this->faker->date,
            'catalog_id' => random_int(1, 3),
        ];
    }
}
