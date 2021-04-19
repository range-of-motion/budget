<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

class UserVerificationTest extends TestCase
{
    private $successfulVerificationText = 'You\'ve succesfully verified';

    public function testValidToken(): void
    {
        $token = 123;

        User::factory()->create([
            'verification_token' => $token
        ]);

        $response = $this
            ->followingRedirects()
            ->get('/verify/' . $token);

        $response
            ->assertStatus(200)
            ->assertSeeText($this->successfulVerificationText);
    }

    public function testInvalidToken(): void
    {
        $token = 456;

        $response = $this
            ->followingRedirects()
            ->get('/verify/' . $token);

        $response
            ->assertStatus(200)
            ->assertDontSeeText($this->successfulVerificationText);
    }
}
