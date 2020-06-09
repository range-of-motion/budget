<?php

use App\Models\Recurring;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnToRecurringsTable extends Migration
{
    public function up(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->string('type')->after('space_id');
        });

        // Set newly introduced column to "spending" everywhere
        foreach (Recurring::all() as $recurring) {
            $recurring->update([
                'type' => 'spending'
            ]);
        }
    }

    public function down(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}
