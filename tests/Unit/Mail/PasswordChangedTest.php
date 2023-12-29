<?php

namespace Tests\Unit\Mail;

use App\Mail\PasswordChanged;
use Tests\TestCase;

class PasswordChangedTest extends TestCase
{
    public function testMailable(): void
    {
        $mailable = new PasswordChanged('2023-12-05 18:00:00');

        $mailable->assertSeeInText('Heads up! Your password has been changed (2023-12-05 18:00:00 CEST).');
    }
}
