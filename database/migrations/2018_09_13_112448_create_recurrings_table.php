<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecurringsTable extends Migration {
    public function up() {
        Schema::create('recurrings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->string('type');
            $table->string('day');
            $table->date('starts_on');
            $table->date('ends_on')->nullable();
            $table->date('last_used_on')->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->string('description');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('recurrings');
    }
}
