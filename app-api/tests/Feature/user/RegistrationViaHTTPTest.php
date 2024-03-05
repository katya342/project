<?php

namespace Tests\Feature;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Tests\TestCase;

class RegistrationViaHTTPTest extends TestCase
{
    use WithFaker;
    public function test_example(): void
    {
        $user = [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => Str::random(6),
        ];
        $response = $this->post('api/register', $user);

        $response->assertStatus(200);
    }
}
