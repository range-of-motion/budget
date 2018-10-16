<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\User;

class VerifyRegistration extends Mailable {
    use Queueable, SerializesModels;

    protected $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function build() {
        return $this->view('emails.verify_registration')
            ->with([
                'name' => $this->user->name
            ]);
    }
}
