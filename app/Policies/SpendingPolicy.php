<?php

namespace App\Policies;

use App\User;
use App\Spending;

class SpendingPolicy {
    public function view(User $user, Spending $spending) {
        return $user->id === $spending->user_id;
    }
}
