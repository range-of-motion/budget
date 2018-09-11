<?php

use Illuminate\Database\Seeder;

use App\Spending;
use App\User;

class SpendingsTableSeeder extends Seeder {
    public function run() {
        factory(Spending::class, 20)->make()->each(function ($spending) {
            $spending->user_id = User::all()->random()->id;
            // Perhaps set tag_id?

            $spending->save();
        });
    }
}
