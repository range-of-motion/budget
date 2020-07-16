<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpaceInvitesTable extends Migration
{
    public function up(): void
    {
        Schema::create('space_invites', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('space_id');
            $table->unsignedInteger('invitee_user_id');
            $table->unsignedInteger('inviter_user_id');
            $table->string('role');
            $table->boolean('accepted')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('space_invites');
    }
}
