<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Subscription;

class DeleteSubsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $user_id = $user->id;
        $sub = Subscription::factory()->create()->toArray();
        $response = $this->delete("api/subscription/delete/${user_id}", $sub);
        $response->assertStatus(200);

    }
}
