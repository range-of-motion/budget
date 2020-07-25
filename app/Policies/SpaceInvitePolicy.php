<?php

namespace App\Policies;

use App\Helper;
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

    public function accept(User $user): bool
    {
        $maximumSpaces = config('plans.' . $user->plan . '.maximum_spaces');

        if (
            Helper::arePlansEnabled()
            && $user->plan === 'standard'
            && $maximumSpaces
            && $user->spaces->count() >= $maximumSpaces
        ) {
            return false;
        }

        return true;
    }
}
