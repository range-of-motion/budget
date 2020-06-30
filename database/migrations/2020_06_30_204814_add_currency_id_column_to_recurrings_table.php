<?php

use App\Models\Recurring;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrencyIdColumnToRecurringsTable extends Migration
{
    public function up(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->unsignedInteger('currency_id')->after('amount');
        });

        // Set "currency_id" for existing recurrings
        foreach (Recurring::all() as $recurring) {
            $recurring->fill([
                'currency_id' => $recurring->space->currency_id
            ])->save();
        }
    }

    public function down(): void
    {
        Schema::table('recurrings', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });
    }
}
