<?php

namespace App\Policies;

use App\Models\Space;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SpacePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Space $space): bool
    {
        $usersSpace = $user->spaces
            ->where('id', $space->id)
            ->first();

        return $usersSpace && $usersSpace->pivot->role === 'admin';
    }
}
