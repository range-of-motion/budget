<?php

namespace App\Mail;

use App\Models\SpaceInvite;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvitedToSpace extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected SpaceInvite $invite,
    ) {
        //
    }

    public function build()
    {
        return $this
            ->view('emails.invited_to_space')
            ->text('emails.invited_to_space_plain')
            ->with(['invite' => $this->invite]);
    }
}
