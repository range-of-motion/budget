<?php

namespace Tests\Feature;

use App\Space;
use App\Spending;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SpendingTest extends TestCase {
    public function testUnauthorizedUserCantDeleteSpending() {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $spending = factory(Spending::class)->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->delete('/spendings/' . $spending->id);

        $response->assertStatus(403);
    }
}
