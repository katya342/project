<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class RegistrationJsonHTTPTest extends TestCase
{
    use WithFaker;
    public function test_example(): void
    {
        $user = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Str::random(6),
        ];
        $response = $this->postJson('api/register', $user);

        $response->assertStatus(200)->assertJson(['status' => true,
        'message' => 'User Created Successfully']);
    }
}
