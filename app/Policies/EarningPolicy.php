<?php

namespace App\Policies;

use App\User;
use App\Earning;

class EarningPolicy {
    public function view(User $user, Earning $earning) {
        return $user->id === $earning->user_id;
    }

    public function delete(User $user, Earning $earning) {
        return $user->id === $earning->user_id;
    }
}
