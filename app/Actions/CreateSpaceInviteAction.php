<?php

namespace App\Actions;

use App\Exceptions\SpaceInviteAlreadyExistsException;
use App\Exceptions\SpaceInviteInviteeAlreadyPresentException;
use App\Models\SpaceInvite;
use App\Models\User;

class CreateSpaceInviteAction
{
    public function execute(int $spaceId, int $inviteeUserId, int $inviterUserId, string $role)
    {
        $inviteeUser = User::find($inviteeUserId);

        if ($inviteeUser->spaces->contains($spaceId)) {
            throw new SpaceInviteInviteeAlreadyPresentException();
        }

        $invite = SpaceInvite::firstOrNew([
            'space_id' => $spaceId,
            'invitee_user_id' => $inviteeUserId
        ], [
            'space_id' => $spaceId,
            'invitee_user_id' => $inviteeUserId,
            'inviter_user_id' => $inviterUserId,
            'role' => $role
        ]);

        if ($invite->id) {
            throw new SpaceInviteAlreadyExistsException();
        }

        $invite->save();

        return $invite;
    }
}
