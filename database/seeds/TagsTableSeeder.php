<?php

use Illuminate\Database\Seeder;

use App\Tag;

class TagsTableSeeder extends Seeder {
    public function run() {
        $names = [
            'Groceries',
            'Bills',
            'Transport'
        ];

        foreach ($names as $name) {
            $currentTimestamp = date('Y-m-d H:i:s');

            Tag::insert([
                'space_id' => 1,
                'name' => $name,
                'created_at' => $currentTimestamp,
                'updated_at' => $currentTimestamp
            ]);
        }
    }
}
