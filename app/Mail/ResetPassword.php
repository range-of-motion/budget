<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected $token,
    ) {
        //
    }

    public function build()
    {
        return $this
            ->view('emails.reset_password')
            ->text('emails.reset_password_plain')
            ->with([
                'token' => $this->token
            ]);
    }
}
