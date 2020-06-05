<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecurringIdColumnToEarningsTable extends Migration
{
    public function up(): void
    {
        Schema::table('earnings', function (Blueprint $table) {
            $table->unsignedInteger('recurring_id')->nullable()->after('space_id');
            $table->foreign('recurring_id')->references('id')->on('recurrings');
        });
    }

    public function down(): void
    {
        Schema::table('earnings', function (Blueprint $table) {
            $table->dropForeign('earnings_recurring_id_foreign');
            $table->dropColumn('recurring_id');
        });
    }
}
