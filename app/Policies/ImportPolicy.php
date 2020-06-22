<?php

namespace App\Policies;

use App\Models\Import;
use App\Models\User;

class ImportPolicy
{
    public function modify(User $user, Import $import)
    {
        return $user->spaces->contains($import->space_id);
    }
}
