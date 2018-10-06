<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Space;
use App\Tag;

class UsersTableSeeder extends Seeder {
    public function run() {
        factory(User::class, 5)->create()->each(function ($user) {
            $space_id = factory(Space::class)->create([
                'name' => $user->name . '\'s Space'
            ]);

            $user->spaces()->attach($space_id);

            factory(Tag::class, 3)->create([
                'space_id' => $space_id
            ]);
        });
    }
}
