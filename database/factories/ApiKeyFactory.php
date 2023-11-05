<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ApiKeyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'token' => Str::random(32),
        ];
    }
}
