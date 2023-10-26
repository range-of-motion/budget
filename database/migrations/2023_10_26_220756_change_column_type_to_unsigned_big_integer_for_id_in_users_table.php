<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    private function dropExistingForeignKeys(): void
    {
        Schema::table('activities', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('ideas', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('login_attempts', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('user_space', fn (Blueprint $table) => $table->dropForeign(['user_id']));
        Schema::table('widgets', fn (Blueprint $table) => $table->dropForeign(['user_id']));
    }

    private function reAddForeignKeys(): void
    {
        Schema::table('activities', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('users'));
        Schema::table('ideas', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('users'));
        Schema::table('login_attempts', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('users'));
        Schema::table('user_space', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('users'));
        Schema::table('widgets', fn (Blueprint $table) => $table->foreign('user_id')->references('id')->on('users'));
    }

    public function up(): void
    {
        $this->dropExistingForeignKeys();

        Schema::table('users', fn (Blueprint $table) => $table->id()->change());

        Schema::table('activities', fn (Blueprint $table) => $table->foreignId('user_id')->change());
        Schema::table('ideas', fn (Blueprint $table) => $table->foreignId('user_id')->change());
        Schema::table('login_attempts', fn (Blueprint $table) => $table->foreignId('user_id')->change());
        Schema::table('user_space', fn (Blueprint $table) => $table->foreignId('user_id')->change());
        Schema::table('widgets', fn (Blueprint $table) => $table->foreignId('user_id')->change());

        $this->reAddForeignKeys();
    }

    public function down(): void
    {
        $this->dropExistingForeignKeys();

        Schema::table('users', fn (Blueprint $table) => $table->increments('id')->change());

        Schema::table('activities', fn (Blueprint $table) => $table->unsignedInteger('user_id')->change());
        Schema::table('ideas', fn (Blueprint $table) => $table->unsignedInteger('user_id')->change());
        Schema::table('login_attempts', fn (Blueprint $table) => $table->unsignedInteger('user_id')->change());
        Schema::table('user_space', fn (Blueprint $table) => $table->unsignedInteger('user_id')->change());
        Schema::table('widgets', fn (Blueprint $table) => $table->unsignedInteger('user_id')->change());

        $this->reAddForeignKeys();
    }
};
