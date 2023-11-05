<?php

namespace Tests\Feature;

use App\Models\ApiKey;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;

class ResolveApiKeyMiddlewareTest extends TestCase
{
    public function testWithoutApiKey(): void
    {
        $response = $this->get('/api/transactions');

        $response->assertStatus(401);
    }

    public function testWithWrongApikey(): void
    {
        $response = $this->get('/api/transactions', ['api_key' => 'WRONG_API_KEY']);

        $response->assertStatus(401);
    }

    public function testWithCorrectApiKey(): void
    {
        $user = User::factory()
            ->create();

        $space = Space::factory()
            ->create();

        $user->spaces()->attach($space->id);

        $apiKey = ApiKey::factory()
            ->create(['user_id' => $user->id]);

        $response = $this->get('/api/transactions', ['api_key' => $apiKey->token]);

        $response->assertStatus(200);
    }
}
