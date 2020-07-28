<?php

namespace App\Actions;

use App\Exceptions\UserAlreadyVerifiedException;
use App\Exceptions\UserNotFoundException;
use App\Exceptions\VerificationMailRateLimitException;
use App\Mail\VerifyRegistration;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SendVerificationMailAction
{
    public function execute(int $userId): void
    {
        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        if (!$user->verification_token) {
            throw new UserAlreadyVerifiedException();
        }

        $differenceInSeconds = strtotime('now') - strtotime($user->last_verification_mail_sent_at);

        if ($user->last_verification_mail_sent_at && $differenceInSeconds < 300) {
            throw new VerificationMailRateLimitException();
        }

        Mail::to($user->email)->queue(new VerifyRegistration($user));

        $user->fill([
            'last_verification_mail_sent_at' => date('Y-m-d H:i:s')
        ])->save();
    }
}
