<?php

namespace App\Policies;

use App\User;
use App\Tag;

class TagPolicy {
    public function update(User $user, Tag $tag) {
        return $user->id === $tag->user_id;
    }
}
