<?php

namespace Tests\Unit\Models;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Earning;

class EarningTest extends TestCase
{
    public function testFormattedAmountAttribute(): void
    {
        $earning = Earning::factory()
            ->make([
                'amount' => 3900,
            ]);

        $this->assertEquals('39.00', $earning->formatted_amount);
    }

    public function testFormattedHappenedOnAttribute(): void
    {
        $earning = Earning::factory()
            ->make([
                'happened_on' => '2020-01-01',
            ]);

        Carbon::setTestNow('2024-01-01');

        $this->assertEquals('1461 days ago', $earning->formatted_happened_on);
    }
}
