<?php

namespace Database\Factories;

use App\Models\Spending;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpendingFactory extends Factory
{
    protected $model = Spending::class;

    public function definition(): array
    {
        return [
            'happened_on' => $this->faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
            'description' => implode(' ', array_map('ucfirst', $this->faker->words(3))),
            'amount' => $this->faker->randomNumber(3)
        ];
    }
}
