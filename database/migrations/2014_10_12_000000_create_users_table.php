<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {
    public function up() {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id')->unsigned();
            $table->string('avatar')->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('verification_token', 100)->nullable();
            $table->rememberToken();
            $table->string('language')->default('en');
            $table->string('theme')->default('light');
            $table->boolean('weekly_report')->default(true);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('users');
    }
}
