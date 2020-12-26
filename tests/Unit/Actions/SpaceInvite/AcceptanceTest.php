<?php

namespace Tests\Unit\Actions\SpaceInvite;

use App\Actions\AcceptSpaceInviteAction;
use App\Exceptions\SpaceInviteNotFoundException;
use App\Models\SpaceInvite;
use App\Models\User;
use Tests\TestCase;

class AcceptanceTest extends TestCase
{
    public function testInviteNotFound(): void
    {
        $this->expectException(SpaceInviteNotFoundException::class);

        (new AcceptSpaceInviteAction())->execute(999);
    }

    public function testSuccessfulAcceptance(): void
    {
        $user = User::factory()->create();
        $invite = SpaceInvite::factory()->create();

        $this->be($user); // Necessary because AcceptSpaceInviteAction uses authentication

        $this->assertEmpty($user->spaces, 'User should not be part of any spaces');

        (new AcceptSpaceInviteAction())->execute($invite->id);

        $this->assertTrue(SpaceInvite::find($invite->id)->accepted, 'Invite should have been accepted');
        $this->assertNotEmpty(User::find($user->id)->spaces, 'User should be part of 1 space');
    }
}
