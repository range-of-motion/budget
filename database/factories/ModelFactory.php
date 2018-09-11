<?php

use Faker\Generator;
use App\User;
use App\Spending;

$factory->define(User::class, function (Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10)
    ];
});

$factory->define(Spending::class, function (Generator $faker) {
    return [
        'happened_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});
