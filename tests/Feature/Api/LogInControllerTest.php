<?php

namespace Tests\Feature\Api;

use App\Models\User;
use Tests\TestCase;

class LogInControllerTest extends TestCase
{
    public function testWithInvalidCredentials(): void
    {
        $response = $this->postJson(
            uri: '/api/log-in',
            data: [
                'email' => 'johnwrongdoe@gmail.com',
                'password' => 'helloworld',
            ],
        );

        $response->assertStatus(403);
    }

    public function testWithValidCredentials(): void
    {
        User::factory()
            ->create([
                'email' => 'johndoe@gmail.com',
                'password' => bcrypt('helloworld'),
            ]);

        $response = $this->postJson(
            uri: '/api/log-in',
            data: [
                'email' => 'johndoe@gmail.com',
                'password' => 'helloworld',
            ],
        );

        $response->assertStatus(200);
    }
}
