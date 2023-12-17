<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->string('plaid_public_token')->nullable()->after('name');
            $table->string('plaid_access_token')->nullable()->after('plaid_public_token');
        });
    }

    public function down(): void
    {
        Schema::table('spaces', function (Blueprint $table) {
            $table->dropColumn('plaid_public_token', 'plaid_access_token');
        });
    }
};
