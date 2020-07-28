<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\ConversionRate;
use Faker\Generator as Faker;

$factory->define(ConversionRate::class, function (Faker $faker) {
    return [
        'rate' => $faker->randomFloat(2, .5, 2)
    ];
});
