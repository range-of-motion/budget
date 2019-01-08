<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTypeColumnToIdeasTable extends Migration {
    public function up() {
        Schema::table('ideas', function (Blueprint $table) {
            $table->string('type')->after('user_id');
        });
    }

    public function down() {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropColumn($table);
        });
    }
}
