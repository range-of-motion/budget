<?php

namespace Tests\Unit\Actions\SpaceInvite;

use App\Actions\DenySpaceInviteAction;
use App\Exceptions\SpaceInviteNotFoundException;
use App\Models\SpaceInvite;
use Tests\TestCase;

class DenialTest extends TestCase
{
    public function testInviteNotFound(): void
    {
        $this->expectException(SpaceInviteNotFoundException::class);

        (new DenySpaceInviteAction())->execute(999);
    }

    public function testSuccessfulDenial(): void
    {
        $invite = SpaceInvite::factory()->create();

        (new DenySpaceInviteAction())->execute($invite->id);

        $this->assertFalse(SpaceInvite::find($invite->id)->accepted, 'Invite should not be accepted');
    }
}
