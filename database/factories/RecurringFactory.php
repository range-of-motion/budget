<?php

namespace Database\Factories;

use App\Models\Recurring;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecurringFactory extends Factory
{
    protected $model = Recurring::class;

    public function definition(): array
    {
        return [
            'type' => 'earning',
            'interval' => 'monthly',
            'day' => $this->faker->numberBetween(1, 28),
            'starts_on' => $this->faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
            'description' => implode(' ', array_map('ucfirst', $this->faker->words(3))),
            'amount' => $this->faker->randomNumber(3)
        ];
    }
}
