<?php

use Illuminate\Database\Seeder;

use App\Currency;

class CurrenciesTableSeeder extends Seeder {
    public function run() {
        Currency::insert([
            [
                'name' => 'Euro',
                'symbol' => '&euro;'
            ],
            [
                'name' => 'Pound',
                'symbol' => '&pound;'
            ]
        ]);
    }
}
