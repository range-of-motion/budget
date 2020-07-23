<?php

namespace Tests\Feature;

use App\Models\Recurring;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurringTest extends TestCase
{
    public function testUnauthorizedUserCantViewRecurring()
    {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $recurring = factory(Recurring::class)->create([
            'space_id' => $space->id,
            'currency_id' => $space->currency_id
        ]);

        $this->actingAs($user);

        $response = $this->get('/recurrings/' . $recurring->id);

        $response->assertStatus(403);
    }

    public function testSuccessfulRecurringCreation(): void
    {
        $user = factory(User::class)->create();
        $space = factory(Space::class)->create();

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
