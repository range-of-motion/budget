<?php

namespace Tests\Feature;

use App\Models\Recurring;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;

class RecurringTest extends TestCase
{
    public function testUnauthorizedUserCantViewRecurring()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $recurring = Recurring::factory()->create([
            'space_id' => $space->id,
            'currency_id' => $space->currency_id
        ]);

        $this->actingAs($user);

        $response = $this->get('/recurrings/' . $recurring->id);

        $response->assertStatus(403);
    }

    public function testSuccessfulRecurringCreation(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        $requestData = [
            'type' => 'spending',
            'interval' => 'monthly',
            'day' => 1,
            'start' => date('Y-m-d'),
            'description' => 'Test',
            'amount' => 123,
            'currency_id' => $space->currency_id
        ];

        $response = $this->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->postJson('/recurrings', $requestData);

        $response->assertStatus(302);
    }
}
