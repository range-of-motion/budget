<?php

namespace Tests\Feature;

use App\Models\User;
use App\Repositories\PasswordResetRepository;
use Illuminate\Support\Str;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function testRequestReset(): void
    {
        $response = $this
            ->followingRedirects()
            ->postJson('/reset_password', [
                'email' => 'jdoe@gmail.com'
            ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('If you registered with that address, we\'ve sent you an e-mail');
    }

    public function testFulfilmentReset(): void
    {
        $user = User::factory()->create();

        $token = Str::random(10);
        $password = 'nuclear1234';

        $passwordResetRepository = new PasswordResetRepository();
        $passwordResetRepository->create($user->email, $token);

        $response = $this
            ->followingRedirects()
            ->postJson('/reset_password', [
                'token' => $token,
                'password' => $password,
                'password_confirmation' => $password // Validation :shrug:
            ]);

        $response
            ->assertStatus(200)
            ->assertSeeText('You\'ve successfully changed your password');
    }
}
