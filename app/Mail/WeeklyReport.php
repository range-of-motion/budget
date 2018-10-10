<?php

namespace App\Mail;

use App\Space;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WeeklyReport extends Mailable {
    use Queueable, SerializesModels;

    protected $space;
    protected $week;
    protected $totalSpent;

    public function __construct(Space $space, $week, $totalSpent) {
        $this->space = $space;
        $this->week = $week;
        $this->totalSpent = $totalSpent;
    }

    public function build() {
        return $this->view('emails.weekly_report')
            ->with([
                'space' => $this->space,
                'week' => $this->week,
                'totalSpent' => $this->totalSpent
            ]);
    }
}
