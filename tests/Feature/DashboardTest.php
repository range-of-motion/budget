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
        $user = factory(User::class)->create();
        $space = factory(Space::class)->create();

        $response = $this
            ->actingAs($user)
            ->withSession(['space' => $space])
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
        $user = factory(User::class)->create();
        $space = factory(Space::class)->create();

        // Earn 10 bucks
        factory(Earning::class)->create([
            'space_id' => $space->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 1000]);

        // Spend 5 bucks
        factory(Spending::class)->create([
            'space_id' => $space->id,
            'happened_on' => date('Y-m-d'),
            'amount' => 500
        ]);

        $response = $this
            ->actingAs($user)
            ->withSession(['space' => $space])
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
