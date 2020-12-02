<?php

namespace App\Repositories;

use App\Models\Currency;
use App\Models\Space;
use Illuminate\Database\Eloquent\Collection;

class CurrencyRepository
{
    public function getById(int $id): ?Currency
    {
        return Currency::find($id);
    }

    public function getAll()
    {
        return Currency::all();
    }

    public function getIfConversionRatePresent(): Collection
    {
        $spaceCurrencyId = [Space::find(session('space_id'))->currency_id];

        return Currency::select('currencies.*')
            ->leftJoin('conversion_rates AS cr', 'cr.base_currency_id', '=', 'currencies.id')
            ->where('cr.target_currency_id', $spaceCurrencyId)
            ->orWhere('currencies.id', $spaceCurrencyId)
            ->groupBy('currencies.id')
            ->get();
    }
}
