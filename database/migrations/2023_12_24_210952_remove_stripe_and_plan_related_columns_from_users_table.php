<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['stripe_customer_id', 'plan']);
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // There's no going back
        });
    }
};
