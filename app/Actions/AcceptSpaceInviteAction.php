<?php

namespace App\Actions;

use App\Exceptions\SpaceInviteNotFoundException;
use App\Models\SpaceInvite;
use Illuminate\Support\Facades\Auth;

class AcceptSpaceInviteAction
{
    public function execute(int $inviteId): void
    {
        $invite = SpaceInvite::find($inviteId);

        if (!$invite) {
            throw new SpaceInviteNotFoundException();
        }

        $invite->fill(['accepted' => true])->save();

        Auth::user()->spaces()->attach($invite->space, ['role' => $invite->role]);
    }
}
