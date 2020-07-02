<?php

namespace App\Repositories;

use App\Models\ConversionRate;
use Exception;

class ConversionRateRepository
{
    public function getByIds(int $baseCurrencyId, int $targetCurrencyId)
    {
        return ConversionRate::where('base_currency_id', $baseCurrencyId)
            ->where('target_currency_id', $targetCurrencyId)
            ->first();
    }

    public function createOrUpdate(int $baseCurrencyId, int $targetCurrencyId, float $rate): void
    {
        $existingConversionRate = $this->getByIds($baseCurrencyId, $targetCurrencyId);

        if ($existingConversionRate) {
            $existingConversionRate->fill([
                'rate' => $rate
            ])->save();
        } else {
            ConversionRate::create([
                'base_currency_id' => $baseCurrencyId,
                'target_currency_id' => $targetCurrencyId,
                'rate' => $rate
            ]);
        }
    }

    /**
     * $amount should be an integer, so if you want to convert "9.99", turn it into "99900" before calling this method
     */
    public function convert(int $baseCurrencyId, int $targetCurrencyId, int $amount): int
    {
        $conversionRate = $this->getByIds($baseCurrencyId, $targetCurrencyId);

        if (!$conversionRate) {
            throw new Exception('Could not find conversion rate');
        }

        return $amount * $conversionRate->rate;
    }
}
