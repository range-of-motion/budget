<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Spending;
use Faker\Generator as Faker;

$factory->define(Spending::class, function (Faker $faker) {
    return [
        'happened_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});
