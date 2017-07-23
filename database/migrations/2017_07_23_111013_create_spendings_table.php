<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpendingsTable extends Migration {
    public function up() {
        Schema::create('spendings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->date('date');
            $table->string('description');
            $table->float('amount');
        });
    }

    public function down() {
        Schema::dropIfExists('spendings');
    }
}
