<?php

namespace Database\Factories;

use App\Models\Space;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceFactory extends Factory
{
    protected $model = Space::class;

    public function definition(): array
    {
        return [
            'currency_id' => $this->faker->numberBetween(1, 3),
            'name' => $this->faker->firstName . '\'s Space'
        ];
    }
}
