<?php

namespace App\Jobs;

use App\Repositories\ConversionRateRepository;
use App\Repositories\CurrencyRepository;
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

    protected $baseCurrencyId;

    private $currencyRepository;
    private $conversionRateRepository;

    public function __construct(int $baseCurrencyId)
    {
        $this->baseCurrencyId = $baseCurrencyId;
    }

    public function handle(
        CurrencyRepository $currencyRepository,
        ConversionRateRepository $conversionRateRepository
    ): void {
        $this->currencyRepository = $currencyRepository;
        $this->conversionRateRepository = $conversionRateRepository;

        $baseCurrency = $this->currencyRepository->getById($this->baseCurrencyId);

        if (!$baseCurrency || !$baseCurrency->iso) {
            return;
        }

        $client = new Client();

        foreach ($this->currencyRepository->getAll() as $targetCurrency) {
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
