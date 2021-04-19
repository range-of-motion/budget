<?php

namespace Tests\Feature;

use App\Models\Space;
use App\Models\Spending;
use App\Models\User;
use Tests\TestCase;

class SpendingTest extends TestCase
{
    public function testUnauthorizedUserCantDeleteSpending()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $spending = Spending::factory()->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->delete('/spendings/' . $spending->id);

        $response->assertStatus(403);
    }
}
