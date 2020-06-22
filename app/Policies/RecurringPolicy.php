<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Recurring;

class RecurringPolicy
{
    public function view(User $user, Recurring $recurring)
    {
        return $user->spaces->contains($recurring->space_id);
    }
}
