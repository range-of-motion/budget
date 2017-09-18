<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDraftsTable extends Migration {
    public function up() {
        Schema::create('drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description');
        });
    }

    public function down() {
        Schema::dropIfExists('drafts');
    }
}
