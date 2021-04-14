<?php

namespace App\Jobs;

use App\Repositories\ConversionRateRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Repositories\EarningRepository;
use App\Repositories\RecurringRepository;
use App\Repositories\SpendingRepository;
use Exception;

class ProcessRecurrings implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $recurringRepository;
    private $conversionRateRepository;
    private $earningRepository;
    private $spendingRepository;

    public function __construct()
    {
        //
    }

    public function handle(
        RecurringRepository $recurringRepository,
        ConversionRateRepository $conversionRateRepository,
        EarningRepository $earningRepository,
        SpendingRepository $spendingRepository
    ) {
        $this->recurringRepository = $recurringRepository;
        $this->conversionRateRepository = $conversionRateRepository;
        $this->earningRepository = $earningRepository;
        $this->spendingRepository = $spendingRepository;

        $yearlyRecurrings = $this->recurringRepository->getDueYearly();
        $monthtlyRecurrings = $this->recurringRepository->getDueMonthly();
        $biweeklyRecurrings = $this->recurringRepository->getDueBiweekly();
        $weeklyRecurrings = $this->recurringRepository->getDueWeekly();
        $dailyRecurrings = $this->recurringRepository->getDueDaily();

        $recurrings = $yearlyRecurrings
            ->merge($monthtlyRecurrings)
            ->merge($biweeklyRecurrings)
            ->merge($weeklyRecurrings)
            ->merge($dailyRecurrings);

        foreach ($recurrings as $recurring) {
            if ($recurring->type !== 'earning' && $recurring->type !== 'spending') {
                throw new Exception('Unknown type "' . $recurring->type . '" for recurring');
            }

            // If necessary, convert amount based on conversion rates
            $amount = $recurring->amount;

            if ($recurring->currency_id !== $recurring->space->currency_id) {
                $amount = $this->conversionRateRepository->convert(
                    $recurring->currency_id,
                    $recurring->space->currency_id,
                    $amount
                );
            }

            // Determine date on which transaction should occur
            $occurancesDates = [];

            $startingDate = ($recurring->last_used_on ?: $recurring->starts_on);
            $today = date('Y-m-d');

            $cursorDate = $startingDate;
            while ($cursorDate <= $today) {
                if (!$recurring->last_used_on || $cursorDate !== $recurring->last_used_on) {
                    $occurancesDates[] = $cursorDate; // Prevent "last_used_on" from being pushed to "occurancesDates"
                }

                switch ($recurring->interval) {
                    case 'daily':
                        $cursorDate = date('Y-m-d', strtotime('+1 day', strtotime($cursorDate)));
                        break;

                    case 'weekly':
                        $cursorDate = date('Y-m-d', strtotime('+1 week', strtotime($cursorDate)));
                        break;

                    case 'biweekly':
                        $cursorDate = date('Y-m-d', strtotime('+2 weeks', strtotime($cursorDate)));
                        break;

                    // Monthly is a different story, because of the different lengths of the months
                    // See below

                    case 'yearly':
                        $cursorDate = date('Y-m-d', strtotime('+1 year', strtotime($cursorDate)));
                        break;
                }

                /**
                 * Take 2020-01-30.
                 *
                 * Next month would be 2020-02-30, but that date doesn't exist.
                 *
                 * Which means it should become 2020-02-29.
                 *
                 * However the iteration after that, shouldn't be 2020-03-29, but rather 2020-03-30, since
                 * the 30th was the day we originally started on.
                 *
                 * Hence why this next piece of code exists :shrug:
                 */
                if ($recurring->interval === 'monthly') {
                    $year = date('Y', strtotime($cursorDate));
                    $month = date('n', strtotime($cursorDate));
                    $day = date('j', strtotime($startingDate));

                    $month++;
                    if ($month > 12) {
                        $month = 1;
                        $year++;
                    }

                    while (!checkdate($month, $day, $year)) {
                        $day--;
                    }

                    $cursorDate = date('Y-m-d', strtotime($year . '-' . $month . '-' . $day));
                }
            }

            foreach ($occurancesDates as $occuranceDate) {
                if ($recurring->type === 'earning') {
                    $this->earningRepository->create(
                        $recurring->space_id,
                        $recurring->id,
                        $occuranceDate,
                        $recurring->description,
                        $amount
                    );
                }

                if ($recurring->type === 'spending') {
                    $this->spendingRepository->create(
                        $recurring->space_id,
                        null,
                        $recurring->id,
                        $recurring->tag_id,
                        $occuranceDate,
                        $recurring->description,
                        $amount
                    );
                }

                $this->recurringRepository->update($recurring->id, [
                    'last_used_on' => $occuranceDate
                ]);
            }
        }
    }
}
