<?php

namespace Tests\Feature;

use App\Models\Earning;
use App\Models\Space;
use App\Models\User;
use Tests\TestCase;

class EarningTest extends TestCase
{
    public function testUnauthorizedUserCantDeleteEarning()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $earning = Earning::factory()->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->delete('/earnings/' . $earning->id);

        $response->assertStatus(403);
    }
}
