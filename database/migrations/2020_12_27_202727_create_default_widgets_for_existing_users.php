<?php

use App\Actions\CreateDefaultWidgetsAction;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultWidgetsForExistingUsers extends Migration
{
    public function up(): void
    {
        foreach (User::all() as $user) {
            if (!$user->widgets->count()) {
                (new CreateDefaultWidgetsAction())->execute($user->id);
            }
        }
    }

    public function down(): void
    {
        // You can't reverse this
    }
}
