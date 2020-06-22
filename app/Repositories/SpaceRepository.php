<?php

namespace App\Repositories;

use App\Models\Space;

class SpaceRepository
{
    public function create(int $currencyId, string $name): Space
    {
        return Space::create([
            'currency_id' => $currencyId,
            'name' => $name
        ]);
    }
}
