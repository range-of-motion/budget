<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameTypeColumnToIntervalInRecurringsTable extends Migration
{
    public function up(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->renameColumn('type', 'interval');
        });
    }

    public function down(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->renameColumn('interval', 'type');
        });
    }
}
