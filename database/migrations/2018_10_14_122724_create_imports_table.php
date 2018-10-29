<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportsTable extends Migration {
    public function up() {
        Schema::create('imports', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->string('name');
            $table->string('file');
            $table->integer('status')->default(0);
            $table->string('column_happened_on')->nullable();
            $table->string('column_description')->nullable();
            $table->string('column_amount')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // FKs
            $table->foreign('space_id')->references('id')->on('spaces');
        });
    }

    public function down() {
        Schema::table('imports', function ($table) {
            $table->dropForeign('imports_space_id_foreign');
        });

        Schema::dropIfExists('imports');
    }
}
