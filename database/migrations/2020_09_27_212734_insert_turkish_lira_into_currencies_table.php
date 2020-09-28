<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertTurkishLiraIntoCurrenciesTable extends Migration
{
    public function up(): void
    {
        DB::table('currencies')->insert([
            'name' => 'Turkish lira',
            'symbol' => 'TRY',
            'iso' => 'TRY'
        ]);
    }

    public function down(): void
    {
        //
    }
}
