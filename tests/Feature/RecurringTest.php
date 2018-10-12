<?php

namespace Tests\Feature;

use App\Recurring;
use App\Space;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RecurringTest extends TestCase {
    public function testUnauthorizedUserCantViewRecurring() {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $recurring = factory(Recurring::class)->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->get('/recurrings/' . $recurring->id);

        $response->assertStatus(403);
    }
}
