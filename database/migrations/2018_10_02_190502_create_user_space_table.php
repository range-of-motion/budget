<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSpaceTable extends Migration {
    public function up() {
        Schema::create('user_space', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('space_id');
            $table->string('role')->default('regular');
        });
    }

    public function down() {
        Schema::dropIfExists('user_space');
    }
}
