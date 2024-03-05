<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Subscription;
use App\Models\User;

class DeleteSubsJsonTest extends TestCase
{

    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $user_id = $user->id;
        $sub = Subscription::factory()->create()->toArray();
        $response = $this->deleteJson("api/subscription/delete/${user_id}", ['message' => 'Subscriptions deleted successfully']);
        $response->assertStatus(200);
    }
}
