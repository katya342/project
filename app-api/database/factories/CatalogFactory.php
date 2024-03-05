<?php

namespace Database\Factories;
use App\Models\Catalog; 

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Catalog>
 */
class CatalogFactory extends Factory
{
    protected $model = Catalog::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'workout_id' => function () {
                return \App\Models\Workout::inRandomOrder()->first()->id;
            },
            'name' => 'Dance',
            'image_path' => 'photos/dance.jpg',
            'description' => 'Dive into a series of cardio dance routines that blend various styles such as hip-hop, salsa, jazz, and more.',
            'difficulty' => 'medium',
            'trainer_id' => 3,
            
        ];
    }
}
