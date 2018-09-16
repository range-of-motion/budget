<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Earning;

class EarningTest extends TestCase {
    public function testFormattedAmount() {
        $earning = factory(Earning::class)->make([
            'amount' => (int) ('39' * 100)
        ]);

        $this->assertEquals('39.00', $earning->formatted_amount);
    }
}
