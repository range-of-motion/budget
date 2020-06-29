<?php

namespace App\Repositories;

use App\Models\ConversionRate;

class ConversionRateRepository
{
    public function createOrUpdate(int $baseCurrencyId, int $targetCurrencyId, float $rate): void
    {
        $existingConversionRate = ConversionRate::where('base_currency_id', $baseCurrencyId)
            ->where('target_currency_id', $targetCurrencyId)
            ->first();

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
}
