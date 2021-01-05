<?php

namespace Database\Factories;

use App\Models\Widget;
use Illuminate\Database\Eloquent\Factories\Factory;

class WidgetFactory extends Factory
{
    protected $model = Widget::class;

    public function definition(): array
    {
        return [
            'sorting_index' => $this->faker->numberBetween(0, 999),
            'properties' => []
        ];
    }
}
