<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Spending;

class SpendingTest extends TestCase {
    public function testFormattedAmount() {
        $spending = factory(Spending::class)->make([
            'amount' => (int) ('92.35' * 100)
        ]);

        $this->assertEquals('92.35', $spending->formatted_amount);
    }
}
