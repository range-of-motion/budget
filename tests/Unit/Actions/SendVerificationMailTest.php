<?php

namespace Tests\Unit;

use App\Actions\SendVerificationMailAction;
use App\Exceptions\UserAlreadyVerifiedException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\VerificationMailRateLimitException;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class SendVerificationMailTest extends TestCase
{
    public function testUserNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);

        (new SendVerificationMailAction())->execute(999);
    }

    public function testAlreadyVerified(): void
    {
        $this->expectException(UserAlreadyVerifiedException::class);

        $user = User::factory()->create([
            'verification_token' => null
        ]);

        (new SendVerificationMailAction())->execute($user->id);
    }

    public function testVerificationRateLimit(): void
    {
        $this->expectException(VerificationMailRateLimitException::class);

        $user = User::factory()->create([
            'verification_token' => 'abc123',
            'last_verification_mail_sent_at' => date('Y-m-d H:i:s', strtotime('1 minute ago'))
        ]);

        (new SendVerificationMailAction())->execute($user->id);
    }

    public function testSuccessfullySent(): void
    {
        $firstVerificationMailSentAt = date('Y-m-d H:i:s', strtotime('7 minute ago'));

        $user = User::factory()->create([
            'verification_token' => 'abc123',
            'last_verification_mail_sent_at' => $firstVerificationMailSentAt
        ]);

        // Prevente mails from actually being sent
        Mail::fake();

        (new SendVerificationMailAction())->execute($user->id);

        $this->assertGreaterThan($firstVerificationMailSentAt, User::find($user->id)->last_verification_mail_sent_at);
    }
}
