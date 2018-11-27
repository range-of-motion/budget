<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddOverdueForeignKeys extends Migration {
    public function up() {
        Schema::table('tags', function ($table) {
            $table->foreign('space_id')->references('id')->on('spaces');
        });

        Schema::table('spendings', function ($table) {
            $table->foreign('space_id')->references('id')->on('spaces');
            $table->foreign('recurring_id')->references('id')->on('recurrings');
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('earnings', function ($table) {
            $table->foreign('space_id')->references('id')->on('spaces');
        });

        Schema::table('recurrings', function ($table) {
            $table->foreign('space_id')->references('id')->on('spaces');
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('user_space', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('space_id')->references('id')->on('spaces');
        });
    }

    public function down() {
        Schema::table('tags', function ($table) {
            $table->dropForeign('tags_space_id_foreign');
        });

        Schema::table('spendings', function ($table) {
            $table->dropForeign('spendings_space_id_foreign');
            $table->dropForeign('spendings_recurring_id_foreign');
            $table->dropForeign('spendings_tag_id_foreign');
        });

        Schema::table('earnings', function ($table) {
            $table->dropForeign('earnings_space_id_foreign');
        });

        Schema::table('recurrings', function ($table) {
            $table->dropForeign('recurrings_space_id_foreign');
            $table->dropForeign('recurrings_tag_id_foreign');
        });

        Schema::table('user_space', function ($table) {
            $table->dropForeign('user_space_user_id_foreign');
            $table->dropForeign('user_space_space_id_foreign');
        });
    }
}
