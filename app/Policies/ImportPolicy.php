<?php

namespace App\Policies;

use App\Import;
use App\User;

class ImportPolicy {
    public function modify(User $user, Import $import) {
        return $user->spaces->contains($import->space_id);
    }
}
