<?php

namespace Tests\Unit\Repositories;

use App\Repositories\RecurringRepository;
use Tests\TestCase;

class RecurringRepositoryTest extends TestCase
{
    private $recurringRepository;

    public function setUp(): void
    {
        parent::setUp();

        $this->recurringRepository = new RecurringRepository();
    }

    public function testCreation(): void
    {
        $spaceId = 1;
        $tagId = 1;

        $recurring = $this->recurringRepository->create($spaceId, 'spending', 'monthly', 3, null, $tagId, 'Foo', 10000);

        $this->assertNotNull($recurring);
        $this->assertEquals(10000, $recurring->amount);
    }
}
