<?php

namespace App\Jobs;

use App\Repositories\CurrencyRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchConversionRates implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $currencyRepository;

    public function handle(CurrencyRepository $currencyRepository): void
    {
        $this->currencyRepository = $currencyRepository;

        foreach ($this->currencyRepository->getAll() as $currency) {
            FetchConversionRate::dispatch($currency->id);
        }
    }
}
