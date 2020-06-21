<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertNordicCurrencies extends Migration
{
    public function up(): void
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Danish Krone',
                'symbol' => 'DKK'
            ],
            [
                'name' => 'Icelandic Krona',
                'symbol' => 'ISK'
            ],
            [
                'name' => 'Norwegian Krone',
                'symbol' => 'NOK'
            ],
            [
                'name' => 'Swedish Krona',
                'symbol' => 'SEK'
            ]
        ]);
    }

    public function down(): void
    {
        //
    }
}
