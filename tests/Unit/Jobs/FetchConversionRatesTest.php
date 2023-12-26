<?php

namespace Tests\Unit\Jobs;

use App\Jobs\FetchConversionRate;
use App\Jobs\FetchConversionRates;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class FetchConversionRatesTest extends TestCase
{
    public function testWhetherIndividualJobsGetDispatched(): void
    {
        Queue::fake();

        Queue::assertNothingPushed();

        app()->call([new FetchConversionRates(), 'handle']);

        Queue::assertPushed(FetchConversionRate::class);
    }
}
