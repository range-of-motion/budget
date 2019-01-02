<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoginAttemptsTable extends Migration {
    public function up() {
        Schema::create('login_attempts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('ip');
            $table->boolean('failed')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::table('login_attempts', function ($table) {
            $table->dropForeign('login_attempts_user_id_foreign');
        });

        Schema::dropIfExists('login_attempts');
    }
}
