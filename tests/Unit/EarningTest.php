<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Earning;

class EarningTest extends TestCase {
    public function testFormattedAmount() {
        $earning = new Earning;

        $earning->user_id = 1;
        $earning->happened_on = date('Y-m-d');
        $earning->description = 'EarningTest testFormattedAmount';
        $earning->amount = 39;

        $earning->save();

        $this->assertEquals('39.00', $earning->formatted_amount);
    }
}
