<?php

namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository
{
    public function getById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function getByVerificationToken(string $token): ?User
    {
        return User::where('verification_token', $token)->first();
    }

    public function verifyById(int $id): void
    {
        $user = $this->getById($id);

        if (!$user) {
            throw new Exception('User (ID ' . $id . ') not found');
        }

        $user->update([
            'verification_token' => null
        ]);
    }
}
