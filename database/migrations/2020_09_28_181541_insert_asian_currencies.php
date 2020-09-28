<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAsianCurrencies extends Migration
{
    public function up(): void
    {
        DB::table('currencies')->insert([
            [
                'name' => 'Yuan',
                'symbol' => '元',
                'iso' => 'CNY'
            ], [
                'name' => 'Yen',
                'symbol' => '&yen;',
                'iso' => 'JPY'
            ], [
                'name' => 'Australian dollar',
                'symbol' => '$',
                'iso' => 'AUD'
            ], [
                'name' => 'Hong Kong dollar',
                'symbol' => 'HK$',
                'iso' => 'HKD'
            ], [
                'name' => 'Indian rupee',
                'symbol' => '₹',
                'iso' => 'INR'
            ], [
                'name' => 'Rupiah',
                'symbol' => 'Rp',
                'iso' => 'IDR'
            ], [
                'name' => 'Ringgit',
                'symbol' => 'RM',
                'iso' => 'MYR'
            ], [
                'name' => 'South Korean won',
                'symbol' => '₩',
                'iso' => 'KRW'
            ], [
                'name' => 'Philippine peso',
                'symbol' => '₱',
                'iso' => 'PHP'
            ], [
                'name' => 'Singapore dollar',
                'symbol' => '$',
                'iso' => 'SGD'
            ], [
                'name' => 'New Taiwan dollar',
                'symbol' => 'NT$',
                'iso' => 'TWD'
            ], [
                'name' => 'Baht',
                'symbol' => '฿',
                'iso' => 'THB'
            ], [
                'name' => 'đồng',
                'symbol' => '₫',
                'iso' => 'VND'
            ]
        ]);
    }

    public function down(): void
    {
        //
    }
}
