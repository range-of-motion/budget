<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Spending;

class SpendingPolicy
{
    public function view(User $user, Spending $spending)
    {
        return $user->spaces->contains($spending->space_id);
    }

    public function edit(User $user, Spending $spending)
    {
        return $user->spaces->contains($spending->space_id);
    }

    public function update(User $user, Spending $spending)
    {
        return $user->spaces->contains($spending->space_id);
    }

    public function delete(User $user, Spending $spending)
    {
        return $user->spaces->contains($spending->space_id);
    }

    public function restore(User $user, Spending $spending)
    {
        return $user->spaces->contains($spending->space_id);
    }
}
