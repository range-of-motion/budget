<?php

namespace Tests\Feature;

use App\Models\Earning;
use App\Models\Space;
use App\Models\Spending;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testEmptySpace(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->get('/dashboard');

        $response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                '0.00',
                'Balance',
                '0.00',
                'Recurrings',
                '0.00',
                'Left to Spend'
            ]);
    }

    public function testUsedSpace(): void
    {
        $user = User::factory()->create();
        $space = Space::factory()->create();

        // Earn 10 bucks
        Earning::factory()->create([
            'space_id' => $space->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 1000]);

        // Spend 5 bucks
        Spending::factory()->create([
            'space_id' => $space->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 500
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession(['space_id' => $space->id])
            ->get('/dashboard');

        $response
            ->assertStatus(200)
            ->assertSeeTextInOrder([
                '5.00',
                'Balance',
                '0.00',
                'Recurrings',
                '5.00',
                'Left to Spend'
            ]);
    }
}
