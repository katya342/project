<?php

namespace Tests\Feature;

use App\Models\Workout;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class GetScheduleJsonTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // $dates = Workout::where('user_id', $user_id)->pluck('date');
        $dates = Workout::factory()->create();
      
        $response = $this->getJson('api/schedule', ['date' => $dates]);
        $response->assertStatus(200);
    }
}
