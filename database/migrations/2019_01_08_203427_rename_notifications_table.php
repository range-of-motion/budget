<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameNotificationsTable extends Migration {
    public function up() {
        Schema::rename('notifications', 'activities');
    }

    public function down() {
        Schema::rename('activities', 'notifications');
    }
}
