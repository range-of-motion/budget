<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEarningsTable extends Migration {
    public function up() {
        Schema::create('earnings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('description');
            $table->integer('amount');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('earnings');
    }
}
