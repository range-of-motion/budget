<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeRecurringEarnings extends Migration {
    public function up() {
        Schema::table('earnings', function (Blueprint $table) {
            $table->integer('recurring_id')->unsigned()->nullable();
            $table->integer('tag_id')->unsigned()->nullable();
            $table->foreign('recurring_id')->references('id')->on('recurrings')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });

        Schema::table('recurrings', function (Blueprint $table) {
            $table->boolean('earning');
        });
    }

    public function down()
    {
        Schema::table('earnings', function (Blueprint $table) {
            $table->dropColumn('recurring_id');
            $table->dropColumn('tag_id');
            $table->dropForeign('spendings_recurring_id_foreign');
            $table->dropForeign('spendings_tag_id_foreign');
        });

        Schema::table('recurrings', function (Blueprint $table) {
            $table->dropColumn('earning');
        });
    }
}
