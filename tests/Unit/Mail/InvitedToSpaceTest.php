<?php

namespace Tests\Unit\Mail;

use App\Mail\InvitedToSpace;
use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Tests\TestCase;

class InvitedToSpaceTest extends TestCase
{
    public function testMailable(): void
    {
        $space = Space::factory()
            ->create([
                'name' => 'Foo Bar',
            ]);

        $inviterUser = User::factory()
            ->create([
                'name' => 'John Doe',
            ]);

        $spaceInvite = SpaceInvite::factory()
            ->create([
                'space_id' => $space->id,
                'inviter_user_id' => $inviterUser->id,
            ]);

        $mailable = new InvitedToSpace($spaceInvite);

        $mailable
            ->assertSeeInText('John Doe has invited you to "Foo Bar".')
            ->assertSeeInHtml('<a href="' . config('app.url') . '/spaces/' . $space->id . '/invites/' . $spaceInvite->id . '">Check out your invite</a>', false); // phpcs:ignore
    }
}
