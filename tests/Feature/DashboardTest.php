<?php

namespace Tests\Feature;

use App\Models\Space;
use App\Models\User;
use App\Models\Widget;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testZeroWidgets(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->get('/dashboard');

        $response->assertStatus(200);
    }

    public function testBalanceWidget(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        Widget::factory()->create([
            'user_id' => $user->id,
            'type' => 'balance'
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->get('/dashboard');

        $response
            ->assertStatus(200)
            ->assertSeeText('Balance');
    }

    public function testSpentWidget(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        Widget::factory()->create([
            'user_id' => $user->id,
            'type' => 'spent',
            'properties' => ['period' => 'this_month']
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->get('/dashboard');

        $response
            ->assertStatus(200)
            ->assertSeeText('Spent this month');
    }
}
