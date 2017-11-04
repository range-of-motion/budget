<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder {
    public function run() {
        Tag::insert([
            [
                'name' => 'Groceries'
            ],
            [
                'name' => 'Bills'
            ],
            [
                'name' => 'Gas & Fuel'
            ]
        ]);
    }
}
