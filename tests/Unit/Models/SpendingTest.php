<?php

namespace Tests\Unit\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Spending;

class SpendingTest extends TestCase
{
    public function testFormattedAmountAttribute(): void
    {
        $spending = Spending::factory()
            ->make([
                'amount' => 9235,
            ]);

        $this->assertEquals('92.35', $spending->formatted_amount);
    }

    public function testFormattedHappenedOnAttribute(): void
    {
        $spending = Spending::factory()
            ->make([
                'happened_on' => '2020-01-01',
            ]);

        Carbon::setTestNow('2024-01-01');

        $this->assertEquals('1461 days ago', $spending->formatted_happened_on);
    }
}
