<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Tests\TestCase;

class PlanExceededTest extends TestCase
{
    public function testMaximumSpacesExcdeededForStandardPlan(): void
    {
        $user = User::factory()->create();
        $firstSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);
        $secondSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);
        $thirdSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);

        // User should be part of 2 spaces
        $user->spaces()->sync([$firstSpace->id, $secondSpace->id]);

        // Invite user for third space
        $invite = SpaceInvite::factory()->create(['space_id' => $thirdSpace->id, 'invitee_user_id' => $user->id]);

        $response = $this
            ->followingRedirects()
            ->actingAs($user)
            ->withSession(['space_id' => $firstSpace->id])
            ->post('/spaces/' . $thirdSpace->id . '/invites/' . $invite->id . '/accept');

        $response
            ->assertStatus(200)
            ->assertSeeText('You have reached the maximum amount of spaces you can be part of.');
    }

    public function testMaximumSpacesExcdeedForPremiumPlan(): void
    {
        $user = User::factory()->create(['plan' => 'premium']);
        $firstSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);
        $secondSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);
        $thirdSpace = Space::factory()->create(['currency_id' => Currency::all()->random()->id]);

        // User should be part of 2 spaces
        $user->spaces()->sync([$firstSpace->id, $secondSpace->id]);

        // Invite user for third space
        $invite = SpaceInvite::factory()->create(['space_id' => $thirdSpace->id, 'invitee_user_id' => $user->id]);

        $response = $this
            ->followingRedirects()
            ->actingAs($user)
            ->withSession(['space_id' => $firstSpace->id])
            ->post('/spaces/' . $thirdSpace->id . '/invites/' . $invite->id . '/accept');

        $response
            ->assertStatus(200)
            ->assertDontSeeText('You have reached the maximum amount of spaces you can be part of.');
    }
}
