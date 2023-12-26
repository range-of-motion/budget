<?php

namespace App\Jobs;

use App\Models\Currency;
use App\Repositories\ConversionRateRepository;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class FetchConversionRate implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private $conversionRateRepository;

    public function __construct(protected int $baseCurrencyId)
    {
        //
    }

    public function handle(ConversionRateRepository $conversionRateRepository): void
    {
        $this->conversionRateRepository = $conversionRateRepository;

        /** @var Currency $baseCurrency */
        $baseCurrency = Currency::query()->find($this->baseCurrencyId);

        if (!$baseCurrency || !$baseCurrency->iso) {
            return;
        }

        $client = new Client();

        foreach (Currency::query()->get() as $targetCurrency) {
            if (!$targetCurrency->iso || $baseCurrency->iso === $targetCurrency->iso) {
                continue;
            }

            $url = sprintf(
                'https://cdn.jsdelivr.net/gh/fawazahmed0/currency-api@1/latest/currencies/%s/%s.json',
                $baseCurrency->iso_lowercased,
                $targetCurrency->iso_lowercased,
            );

            try {
                $response = $client->request('GET', $url);

                $decoded_response = json_decode($response->getBody(), true);

                $rate = $decoded_response[$targetCurrency->iso_lowercased];
            } catch (Exception $e) {
                continue;
            }

            $this->conversionRateRepository->createOrUpdate(
                $baseCurrency->id,
                $targetCurrency->id,
                $rate
            );
        }
    }
}
