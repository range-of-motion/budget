<?php

namespace App\Repositories;

use App\Models\LoginAttempt;

class LoginAttemptRepository
{
    public function create(?int $userId, string $ip, bool $failed): LoginAttempt
    {
        return LoginAttempt::create([
            'user_id' => $userId,
            'ip' => $ip,
            'failed' => $failed
        ]);
    }
}
