<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Earning;

class EarningPolicy
{
    public function view(User $user, Earning $earning)
    {
        return $user->spaces->contains($earning->space_id);
    }

    public function edit(User $user, Earning $earning)
    {
        return $user->spaces->contains($earning->space_id);
    }

    public function update(User $user, Earning $earning)
    {
        return $user->spaces->contains($earning->space_id);
    }

    public function delete(User $user, Earning $earning)
    {
        return $user->spaces->contains($earning->space_id);
    }

    public function restore(User $user, Earning $earning)
    {
        return $user->spaces->contains($earning->space_id);
    }
}
