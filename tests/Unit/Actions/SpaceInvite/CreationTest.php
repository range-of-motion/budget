<?php

namespace Tests\Unit\Actions\SpaceInvite;

use App\Actions\CreateSpaceInviteAction;
use App\Exceptions\SpaceInviteAlreadyExistsException;
use App\Exceptions\SpaceInviteInviteeAlreadyPresentException;
use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Tests\TestCase;

class CreationTest extends TestCase
{
    public function testInviteeAlreadyPresent(): void
    {
        $space = factory(Space::class)->create();
        $inviteeUser = factory(User::class)->create();
        $inviterUser = factory(User::class)->create();

        $inviteeUser->spaces()->attach($space->id, ['role' => 'regular']);

        $this->expectException(SpaceInviteInviteeAlreadyPresentException::class);

        (new CreateSpaceInviteAction())->execute(
            $space->id,
            $inviteeUser->id,
            $inviterUser->id,
            'regular'
        );
    }

    public function testInviteAlreadyExists(): void
    {
        $space = factory(Space::class)->create();
        $inviteeUser = factory(User::class)->create();
        $inviterUser = factory(User::class)->create();

        factory(SpaceInvite::class)->create([
            'space_id' => $space->id,
            'invitee_user_id' => $inviteeUser->id
        ]);

        $this->expectException(SpaceInviteAlreadyExistsException::class);

        (new CreateSpaceInviteAction())->execute(
            $space->id,
            $inviteeUser->id,
            $inviterUser->id,
            'regular'
        );
    }

    public function testSuccessfulCreation(): void
    {
        $space = factory(Space::class)->create();
        $inviteeUser = factory(User::class)->create();
        $inviterUser = factory(User::class)->create();

        $invite = (new CreateSpaceInviteAction())->execute(
            $space->id,
            $inviteeUser->id,
            $inviterUser->id,
            'regular'
        );

        $this->assertNotNull($invite->id, 'Invite should have been persisted');
    }
}
