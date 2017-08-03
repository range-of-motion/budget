<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBudgetsTable extends Migration {
    public function up() {
        Schema::create('budgets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('month');
            $table->integer('year');
            $table->float('amount');
        });
    }

    public function down() {
        Schema::dropIfExists('budgets');
    }
}
