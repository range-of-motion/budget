<?php

namespace App\Mail;

use App\Models\Space;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class WeeklyReport extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        protected Space $space,
        protected $week,
        protected $totalSpent,
        protected $largestSpendingWithTag
    ) {
        //
    }

    public function build()
    {
        return $this
            ->view('emails.weekly_report')
            ->text('emails.weekly_report_plain')
            ->with([
                'space' => $this->space,
                'week' => $this->week,
                'totalSpent' => $this->totalSpent,
                'largestSpendingWithTag' => $this->largestSpendingWithTag
            ]);
    }
}
