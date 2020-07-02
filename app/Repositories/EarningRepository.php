<?php

namespace App\Repositories;

use App\Models\Earning;
use Exception;

class EarningRepository
{
    public function getValidationRules(): array
    {
        return [
            'date' => 'required|date|date_format:Y-m-d',
            'description' => 'required|max:255',
            'currency_id' => 'nullable|exists:currencies,id',
            'amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ];
    }

    public function create(int $spaceId, ?int $recurringId, string $date, string $description, int $amount): Earning
    {
        return Earning::create([
            'space_id' => $spaceId,
            'recurring_id' => $recurringId,
            'happened_on' => $date,
            'description' => $description,
            'amount' => $amount
        ]);
    }

    public function update(int $earningId, array $data): void
    {
        $earning = Earning::find($earningId);

        if (!$earning) {
            throw new Exception('Could not find earning with ID ' . $earningId);
        }

        $earning->fill($data)->save();
    }
}
