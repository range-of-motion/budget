<?php

namespace Tests\Unit\Mail;

use App\Mail\ResetPassword;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function testMailable(): void
    {
        $mailable = new ResetPassword('123456789');

        $mailable->assertSeeInHtml('<a href="' . config('app.url') . '/reset_password?token=123456789">Click here to change your password</a>', false); // phpcs:ignore
    }
}
