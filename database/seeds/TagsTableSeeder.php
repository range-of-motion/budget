<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder {
    public function run() {
        Tag::insert([
            [
                'user_id' => 1,
                'name' => 'Groceries'
            ],
            [
                'user_id' => 1,
                'name' => 'Bills'
            ],
            [
                'user_id' => 1,
                'name' => 'Gas & Fuel'
            ]
        ]);
    }
}
