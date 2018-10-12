<?php

use Faker\Generator;
use App\User;
use App\Space;
use App\Tag;
use App\Earning;
use App\Spending;
use App\Recurring;

$factory->define(User::class, function (Generator $faker) {
    return [
        'currency_id' => $faker->numberBetween(1, 3),
        'name' => $faker->firstName,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10)
    ];
});

$factory->define(Space::class, function (Generator $faker) {
    return [
        'name' => $faker->firstName . '\'s Space'
    ];
});

$factory->define(Tag::class, function (Generator $faker) {
    return [
        'name' => ucfirst($faker->word)
    ];
});

$factory->define(Earning::class, function (Generator $faker) {
    return [
        'happened_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});

$factory->define(Spending::class, function (Generator $faker) {
    return [
        'happened_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});

$factory->define(Recurring::class, function (Generator $faker) {
    return [
        'type' => 'monthly',
        'day' => $faker->numberBetween(1, 28),
        'starts_on' => $faker->dateTimeBetween('-50 days', 'now')->format('Y-m-d'),
        'description' => implode(' ', array_map('ucfirst', $faker->words(3))),
        'amount' => $faker->randomNumber(3)
    ];
});
