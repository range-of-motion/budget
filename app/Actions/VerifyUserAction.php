<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class VerifyUserAction
{
    public function execute(int $id): void
    {
        $user = User::find($id);

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->update(['verification_token' => null]);
    }
}
