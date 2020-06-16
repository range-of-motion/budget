<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertSouthAmericanCurrencies extends Migration
{
    public function up() {
        DB::table('currencies')->insert([
            [
                'name' => 'Argentine Peso',
                'symbol' => 'ARS'
            ], [
                'name' => 'Bolivian Boliviano',
                'symbol' => 'BOB'
            ], [
                'name' => 'Brazilian Real',
                'symbol' => 'BRL'
            ], [
                'name' => 'Chilean Peso',
                'symbol' => 'CLP'
            ], [
                'name' => 'Colombian Peso',
                'symbol' => 'COP'
            ], [
                'name' => 'Paraguayan Guarani',
                'symbol' => 'PYG'
            ], [
                'name' => 'Peruvian Novo Sol',
                'symbol' => 'PEN'
            ], [
                'name' => 'Uruguayan Peso',
                'symbol' => 'UYU'
            ], [
                'name' => 'Venezuelan Bolivar',
                'symbol' => 'VES'
            ]
        ]);
    }

    public function down() {
        //
    }
}
