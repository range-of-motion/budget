<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Space;

class UsersTableSeeder extends Seeder {
    public function run() {
        factory(User::class, 5)->create()->each(function ($user) {
            $user->spaces()->attach(factory(Space::class)->create([
                'name' => $user->name . '\'s Space'
            ]));
        });
    }
}
