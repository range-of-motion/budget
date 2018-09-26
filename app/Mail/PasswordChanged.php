<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class PasswordChanged extends Mailable {
    use Queueable, SerializesModels;

    protected $updated_at;

    public function __construct($updated_at) {
        $this->updated_at = $updated_at;
    }

    public function build() {
        return $this->view('emails.password_changed')
            ->with([
                'updated_at' => $this->updated_at
            ]);
    }
}
