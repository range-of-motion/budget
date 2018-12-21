<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColorToTagsTable extends Migration {
    public function up() {
        Schema::table('tags', function (Blueprint $table) {
            $table->char('color', 6)->after('name');
        });
    }

    public function down() {
        Schema::table('tags', function (Blueprint $table) {
            $table->dropColumn('color');
        });
    }
}
