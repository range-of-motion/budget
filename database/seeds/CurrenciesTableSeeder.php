<?php

use Illuminate\Database\Seeder;

use App\Currency;

class CurrenciesTableSeeder extends Seeder {
    public function run() {
        Currency::create([
            'name' => 'Euro',
            'symbol' => '&euro;'
        ]);
    }
}
