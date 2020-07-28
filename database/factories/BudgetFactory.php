<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Budget;
use Faker\Generator as Faker;

$factory->define(Budget::class, function (Faker $faker) {
    return [
        'period' => 'monthly',
        'amount' => $faker->randomNumber(3)
    ];
});
