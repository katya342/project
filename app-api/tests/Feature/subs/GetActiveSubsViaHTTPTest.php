<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Subscription;
use App\Models\User;

class GetActiveSubsViaHTTPTest extends TestCase
{
    public function test_example(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $subs = Subscription::factory()->create(['active' => '1'])->first(); // Добавляем метод first() для выполнения запроса и получения модели
        $response = $this->get('api/user/active-subs', ['Authorization' => 'Bearer ' . $subs->token]); // Используем атрибут token модели
        $response->assertStatus(200);
    }

}
