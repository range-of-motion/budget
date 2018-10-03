<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpendingsTable extends Migration {
    public function up() {
        Schema::create('spendings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->integer('recurring_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->date('happened_on');
            $table->string('description');
            $table->integer('amount');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down() {
        Schema::dropIfExists('spendings');
    }
}
