<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(SpaceInvite::class, function (Faker $faker) {
    return [
        'space_id' => Space::all()->random()->id,
        'invitee_user_id' => User::all()->random()->id,
        'inviter_user_id' => User::all()->random()->id,
        'role' => 'regular'
    ];
});
