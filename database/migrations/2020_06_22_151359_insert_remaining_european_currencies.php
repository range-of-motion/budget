<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class InsertRemainingEuropeanCurrencies extends Migration
{
    public function up(): void
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Albanian Lek',
                'symbol' => 'ALL'
            ],
            [
                'name' => 'Armenian Dram',
                'symbol' => 'AMD'
            ],
            [
                'name' => 'Azerbaijani Manat',
                'symbol' => 'AZN'
            ],
            [
                'name' => 'Bosnia and Herzegovina Convertible Mark',
                'symbol' => 'BAM'
            ],
            [
                'name' => 'Bulgarian Lev',
                'symbol' => 'BGN'
            ],
            [
                'name' => 'Belarusian Ruble',
                'symbol' => 'BYN'
            ],
            [
                'name' => 'Swiss Franc',
                'symbol' => 'CHF'
            ],
            [
                'name' => 'Czech Koruna',
                'symbol' => 'CZK'
            ],
        ]);
    }

    public function down(): void
    {
        //
    }
}
