<?php

use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder {
    public function run() {
        User::create([
            'currency_id' => 1,
            'name' => 'Sjaak',
            'email' => 'sjaak@blaaskaak.com',
            'password' => Hash::make('sjaak123')
        ]);
    }
}
