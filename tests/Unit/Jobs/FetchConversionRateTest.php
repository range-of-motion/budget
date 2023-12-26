<?php

namespace Tests\Unit\Jobs;

use App\Jobs\FetchConversionRate;
use App\Models\ConversionRate;
use Tests\TestCase;

class FetchConversionRateTest extends TestCase
{
    public function testWhetherConversionRatesGetFetched(): void
    {
        $this->assertDatabaseEmpty(ConversionRate::class);

        app()->call([new FetchConversionRate(1), 'handle']);

        $this->assertDatabaseHas(
            ConversionRate::class,
            [
                'base_currency_id' => 1,
                'target_currency_id' => 2,
            ],
        );

        $this->assertDatabaseHas(
            ConversionRate::class,
            [
                'base_currency_id' => 1,
                'target_currency_id' => 3,
            ],
        );

        // etc.
    }
}
