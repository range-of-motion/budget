<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Spending;

class SpendingTest extends TestCase {
    public function testFormattedAmount() {
        $spending = new Spending;

        $spending->user_id = 1;
        // $spending->tag_id = null;
        $spending->happened_on = date('Y-m-d');
        $spending->description = 'SpendingTest testFormattedAmount';
        $spending->amount = 92;

        $spending->save();

        $this->assertEquals('92.00', $spending->formatted_amount);
    }
}
