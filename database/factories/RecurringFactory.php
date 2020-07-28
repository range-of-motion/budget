<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Recurring;
use Faker\Generator as Faker;

$factory->define(Recurring::class, function (Faker $faker) {
    return [
        'type' => 'earning',
        'interval' => 'monthly',
        'day' => $faker->numberBetween(1, 28),
        'starts_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});
