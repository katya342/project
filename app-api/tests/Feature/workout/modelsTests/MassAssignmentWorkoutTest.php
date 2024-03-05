<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Workout;
use App\Models\User;

class MassAssignmentWorkoutTest extends TestCase
{
    public function test_only_fillable_fields_are_mass_assignable()
{
    // Создаем пользователя
    $user = User::factory()->create();

    // Создаем массив данных для тренировки, включая поле, которое не указано в $fillable
    $data = [
        'user_id' => $user->id,
        'title' => 'Test Workout',
        'description' => 'Test workout description.',
        'date' => '2024-02-19',
        'non_fillable_field' => 'Non-fillable field value', // Поле, не указанное в $fillable
    ];

    // Пытаемся создать запись с массовым заполнением данных
    $workout = Workout::create($data);

    // Убеждаемся, что запись существует в базе данных
    $this->assertDatabaseHas('workouts', [
        'user_id' => $user->id,
        'title' => 'Test Workout',
        'description' => 'Test workout description.',
        'date' => '2024-02-19',
    ]);

    // Убеждаемся, что запись не содержит поля, не указанного в $fillable
    $this->assertArrayNotHasKey('non_fillable_field', $workout->toArray());
}

}
