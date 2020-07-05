<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Tag;

class TagPolicy
{
    public function view(User $user, Tag $tag)
    {
        return $user->spaces->contains($tag->space_id);
    }

    public function edit(User $user, Tag $tag)
    {
        return $user->spaces->contains($tag->space_id);
    }

    public function update(User $user, Tag $tag)
    {
        return $user->spaces->contains($tag->space_id);
    }

    public function delete(User $user, Tag $tag)
    {
        return $user->spaces->contains($tag->space_id);
    }
}
