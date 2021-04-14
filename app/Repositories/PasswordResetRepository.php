<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class PasswordResetRepository
{
    public function getByEmail(string $email)
    {
        return DB::selectOne('SELECT * FROM password_resets WHERE email = ?', [$email]);
    }

    public function getByToken(string $token)
    {
        return DB::selectOne('SELECT * FROM password_resets WHERE token = ?', [$token]);
    }

    public function create(string $email, string $token): void
    {
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s')
        ]);
    }

    public function delete(string $token): void
    {
        DB::table('password_resets')->where('token', $token)->delete();
    }
}
