<?php

namespace App\Jobs;

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
    private $earningRepository;
    private $spendingRepository;

    public function __construct()
    {
        //
    }

    public function handle(
        RecurringRepository $recurringRepository,
        EarningRepository $earningRepository,
        SpendingRepository $spendingRepository
    ) {
        $this->recurringRepository = $recurringRepository;
        $this->earningRepository = $earningRepository;
        $this->spendingRepository = $spendingRepository;

        $yearlyRecurrings = $this->recurringRepository->getDueYearly();
        $monthtlyRecurrings = $this->recurringRepository->getDueMonthly();
        $dailyRecurrings = $this->recurringRepository->getDueDaily();

        $recurrings = $yearlyRecurrings->combine($monthtlyRecurrings->combine($dailyRecurrings));

        foreach ($recurrings as $recurring) {
            if ($recurring->type !== 'earning' && $recurring->type !== 'spending') {
                throw new Exception('Unknown type "' . $recurring->type . '" for recurring');
            }

            if ($recurring->type === 'earning') {
                $this->earningRepository->create(
                    $recurring->space_id,
                    $recurring->id,
                    date('Y-m-d'),
                    $recurring->description,
                    $recurring->amount
                );
            }

            if ($recurring->type === 'spending') {
                $this->spendingRepository->create(
                    $recurring->space_id,
                    null,
                    $recurring->id,
                    $recurring->tag_id,
                    date('Y-m-d'),
                    $recurring->description,
                    $recurring->amount
                );
            }

            $this->recurringRepository->update($recurring->id, [
                'last_used_on' => date('Y-m-d')
            ]);
        }
    }
}
