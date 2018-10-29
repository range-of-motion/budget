<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertMajorWesternCurrencies extends Migration {
    public function up() {
        DB::table('currencies')->insert([
            [
                'name' => 'Euro',
                'symbol' => '&euro;'
            ], [
                'name' => 'US Dollar',
                'symbol' => '&dollar;'
            ], [
                'name' => 'British Pound',
                'symbol' => '&pound;'
            ]
        ]);
    }

    public function down() {
        //
    }
}
