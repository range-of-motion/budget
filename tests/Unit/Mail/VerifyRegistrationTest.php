<?php

namespace Tests\Unit\Mail;

use App\Mail\VerifyRegistration;
use App\Models\User;
use Tests\TestCase;

class VerifyRegistrationTest extends TestCase
{
    public function testMailable(): void
    {
        $user = User::factory()
            ->create([
                'name' => 'John Doe',
                'verification_token' => 'abc123',
            ]);

        $mailable = new VerifyRegistration($user);

        $mailable
            ->assertSeeInText('Welcome aboard, John Doe')
            ->assertSeeInText('We\'re going to help you get insight into your personal finances.')
            ->assertSeeInText('No more dealing with pesky, half-assed spreadsheets.')
            ->assertSeeInHtml('<a href="' . config('app.url') . '/verify/abc123">Verify</a>', false);
    }
}
