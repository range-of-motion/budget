<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivitiesTable extends Migration {
    public function up() {
        Schema::create('activities', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('space_id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('entity_id');
            $table->string('entity_type');
            $table->string('action');
            $table->timestamps();

            $table->foreign('space_id')->references('id')->on('spaces');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    public function down() {
        Schema::table('activities', function ($table) {
            $table->dropForeign('activities_space_id_foreign');
            $table->dropForeign('activities_user_id_foreign');
        });

        Schema::dropIfExists('activities');
    }
}
