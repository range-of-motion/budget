<?php

namespace Tests\Unit\Models;

use App\Models\Budget;
use App\Models\Space;
use App\Models\Spending;
use App\Models\Tag;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    public function testFormattedAmountAttribute(): void
    {
        $budget = Budget::factory()
            ->create(['amount' => 750]);

        $this->assertEquals('7.50', $budget->formatted_amount);
    }

    public function testSpentAttribute(): void
    {
        $space = Space::factory()
            ->create();

        $tag = Tag::factory()
            ->create([
                'space_id' => $space->id,
            ]);

        $budget = Budget::factory()
            ->create([
                'tag_id' => $tag->id,
                'period' => 'monthly',
                'amount' => 750,
            ]);

        Spending::factory()
            ->create([
                'space_id' => $space->id,
                'tag_id' => $tag->id,
                'happened_on' => date('Y-m-d'),
                'amount' => 100,
            ]);

        // Set session accordingly
        $this->withSession(['space_id' => $space->id]);

        $this->assertEquals(100, $budget->spent);
    }

    public function testFormattedSpentAttribute(): void
    {
        $space = Space::factory()
            ->create();

        $tag = Tag::factory()
            ->create([
                'space_id' => $space->id,
            ]);

        $budget = Budget::factory()
            ->create([
                'tag_id' => $tag->id,
                'period' => 'monthly',
                'amount' => 750,
            ]);

        Spending::factory()
            ->create([
                'space_id' => $space->id,
                'tag_id' => $tag->id,
                'happened_on' => date('Y-m-d'),
                'amount' => 100,
            ]);

        // Set session accordingly
        $this->withSession(['space_id' => $space->id]);

        $this->assertEquals('1.00', $budget->formatted_spent);
    }
}
