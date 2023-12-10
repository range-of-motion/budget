<?php

namespace Tests\Feature\Api;

use App\Models\Activity;
use App\Models\ApiKey;
use App\Models\Earning;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public function testStoreEndpoint(): void
    {
        $user = User::factory()
            ->create();

        $space = Space::factory()
            ->create();

        $user->spaces()->attach($space->id);

        $apiKey = ApiKey::factory()
            ->create(['user_id' => $user->id]);

        $response = $this->postJson(
            '/api/transactions',
            [
                'type' => 'earning',
                'happened_on' => '2021-01-01',
                'description' => 'Helping grandma',
                'amount' => 10.50,
            ],
            [
                'api-key' => $apiKey->token,
            ],
        );

        $response->assertStatus(200);

        $this->assertDatabaseHas(
            Earning::class,
            [
                'happened_on' => '2021-01-01',
                'description' => 'Helping grandma',
                'amount' => 1050,
            ],
        );

        $this->assertDatabaseHas(
            Activity::class,
            [
                'space_id' => $space->id,
                'user_id' => $user->id,
                'entity_type' => 'earning', // TODO: create enum
                'action' => 'transaction.created', // TODO: also create enum
            ],
        );
    }
}
