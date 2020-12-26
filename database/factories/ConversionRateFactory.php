<?php

namespace Database\Factories;

use App\Models\ConversionRate;
use Illuminate\Database\Eloquent\Factories\Factory;

class ConversionRateFactory extends Factory
{
    protected $model = ConversionRate::class;

    public function definition(): array
    {
        return [
            'rate' => $this->faker->randomFloat(2, .5, 2)
        ];
    }
}
