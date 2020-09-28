<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertJapaneseYenIntoCurrenciesTable extends Migration
{
    public function up(): void
    {
        DB::table('currencies')->insert([
            'name' => 'Japenese yen',
            'symbol' => '&yen;',
            'iso' => 'JPY'
        ]);
    }

    public function down(): void
    {
        //
    }
}
