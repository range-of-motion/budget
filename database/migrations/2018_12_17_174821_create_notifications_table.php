<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration {
    public function up() {
        Schema::create('notifications', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->string('action');
            $table->timestamps();

            $table->foreign('space_id')->references('id')->on('spaces');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::table('notifications', function ($table) {
            $table->dropForeign('notifications_space_id_foreign');
            $table->dropForeign('notifications_user_id_foreign');
        });

        Schema::dropIfExists('notifications');
    }
}
