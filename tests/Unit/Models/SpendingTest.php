<?php

namespace Tests\Unit\Models;

use App\Helper;
use Tests\TestCase;
use App\Models\Spending;

class SpendingTest extends TestCase
{
    public function testFormattedAmount()
    {
        $spending = Spending::factory()->make([
            'amount' => Helper::rawNumberToInteger(92.35)
        ]);

        $this->assertEquals('92.35', $spending->formatted_amount);
    }
}
