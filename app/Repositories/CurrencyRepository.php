<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository
{
    public function getAll()
    {
        return Currency::all();
    }

    public function getKeyValueArray(): array
    {
        $response = [];

        foreach ($this->getAll() as $currency) {
            $response[] = [
                'key' => $currency->id,
                'label' => $currency->symbol
            ];
        }

        return $response;
    }
}
