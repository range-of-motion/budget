<?php

namespace App\Policies;

use App\Models\SpaceInvite;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpaceInvitePolicy
{
    use HandlesAuthorization;

    public function access(User $user, SpaceInvite $invite)
    {
        return $invite->invitee_user_id === $user->id;
    }
}
