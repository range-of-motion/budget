<?php

namespace Database\Factories;

use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpaceInviteFactory extends Factory
{
    protected $model = SpaceInvite::class;

    public function definition(): array
    {
        return [
            'space_id' => Space::all()->random()->id,
            'invitee_user_id' => User::all()->random()->id,
            'inviter_user_id' => User::all()->random()->id,
            'role' => 'regular'
        ];
    }
}
