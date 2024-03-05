<?php

namespace Tests\Feature;

use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Carbon\Carbon;

class CheckNewWorkoutTest extends TestCase
{
    
    public function testCheckForNewWorkout()
    {
        // Создаем пользователя
        $user = User::factory()->create();
        
        // Устанавливаем время последней проверки пользователя как текущее время минус 1 минута
        $user->last_workout_check = Carbon::now()->subMinute();
        $user->save();

        // Создаем новую тренировку, которая была создана после времени последней проверки пользователя
        $newWorkout = Workout::factory()->create(['created_at' => Carbon::now()]);

        // Делаем GET-запрос к методу checkForNewWorkout
        $response = $this->actingAs($user)->get(route('check-for-new-workout'));

        // Проверяем, что ответ содержит JSON-данные с флагом newWorkout
        $response->assertJson([
            'newWorkout' => true,
        ]);

        // Проверяем, что время последней проверки пользователя было обновлено
        $this->assertEquals($user->fresh()->last_workout_check, $newWorkout->created_at->toDateTimeString());
    }
}
