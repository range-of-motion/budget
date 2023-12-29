<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PasswordChanged extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected $updated_at,
    ) {
        //
    }

    public function build()
    {
        return $this
            ->view('emails.password_changed')
            ->text('emails.password_changed_plain')
            ->with([
                'updated_at' => $this->updated_at
            ]);
    }
}
