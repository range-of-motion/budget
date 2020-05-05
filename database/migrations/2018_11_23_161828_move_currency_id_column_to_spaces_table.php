<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveCurrencyIdColumnToSpacesTable extends Migration {
    public function up() {
        // Create
        Schema::table('spaces', function (Blueprint $table) {
            $table->unsignedInteger('currency_id')->after('id');

        });

        // Move
        foreach (\App\Models\Space::all() as $space) {
            $user = $space->users()->first();

            $space->currency_id = $user->currency_id;
            $space->save();
        }

        // FK
        Schema::table('spaces', function (Blueprint $table) {
             $table->foreign('currency_id')->references('id')->on('currencies');
        });

        // Drop
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('currency_id');
        });
    }

    public function down() {
        //
    }
}
