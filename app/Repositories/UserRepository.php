<?php

namespace App\Repositories;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserRepository
{
    public function getValidationRulesForRegistration(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
            'currency' => 'required|exists:currencies,id'
        ];
    }

    public function getById(int $id): ?User
    {
        return User::where('id', $id)->first();
    }

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
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

    public function create(string $name, string $email, string $password): User
    {
        return User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'verification_token' => Str::random(100)
        ]);
    }
}
