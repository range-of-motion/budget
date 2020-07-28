<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Space;
use Faker\Generator as Faker;

$factory->define(Space::class, function (Faker $faker) {
    return [
        'currency_id' => $faker->numberBetween(1, 3),
        'name' => $faker->firstName . '\'s Space'
    ];
});
