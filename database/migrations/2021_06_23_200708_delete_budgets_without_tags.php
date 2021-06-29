<?php

use App\Models\Budget;
use App\Models\Tag;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DeleteBudgetsWithoutTags extends Migration
{
    public function up(): void
    {
        foreach (Budget::all() as $budget) {
            $hasStrayTag = $budget->tag_id && !$budget->tag;

            if ($hasStrayTag) {
                $budget->delete();
            }
        }
    }

    public function down(): void
    {
        //
    }
}
