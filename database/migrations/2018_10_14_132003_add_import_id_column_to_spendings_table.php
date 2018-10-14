<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImportIdColumnToSpendingsTable extends Migration {
    public function up() {
        Schema::table('spendings', function (Blueprint $table) {
            $table->unsignedInteger('import_id')->nullable()->after('space_id');

            // FK
            $table->foreign('import_id')->references('id')->on('imports');
        });
    }

    public function down() {
        Schema::table('spendings', function (Blueprint $table) {
            // FK
            $table->dropForeign('spendings_import_id_foreign');

            $table->dropColumn('import_id');
        });
    }
}
