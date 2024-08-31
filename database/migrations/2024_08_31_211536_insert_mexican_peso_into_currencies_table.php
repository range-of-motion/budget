<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('currencies')
            ->insert([
                [
                    'name' => 'Mexican peso',
                    'symbol' => '$',
                    'iso' => 'MXN'
                ]
            ]);
    }

    public function down(): void
    {
        DB::table('currencies')
            ->where('iso', 'MXN')
            ->delete();
    }
};
