<?php

namespace App\Actions;

use App\Exceptions\SpaceInviteNotFoundException;
use App\Models\SpaceInvite;

class DenySpaceInviteAction
{
    public function execute(int $inviteId): void
    {
        $invite = SpaceInvite::find($inviteId);

        if (!$invite) {
            throw new SpaceInviteNotFoundException();
        }

        $invite->fill(['accepted' => false])->save();
    }
}
