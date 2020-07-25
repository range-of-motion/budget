<?php

namespace App\Policies;

use App\Helper;
use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpacePolicy
{
    use HandlesAuthorization;

    public function create(User $user): bool
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

    public function edit(User $user, Space $space): bool
    {
        $usersSpace = $user->spaces
            ->where('id', $space->id)
            ->first();

        return $usersSpace && $usersSpace->pivot->role === 'admin';
    }
}
