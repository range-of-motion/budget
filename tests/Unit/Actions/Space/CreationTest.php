<?php

namespace Tests\Unit\Actions\Space;

use App\Actions\CreateSpaceAction;
use Tests\TestCase;

class CreationTest extends TestCase
{
    public function testSuccessfulCreation(): void
    {
        $space = (new CreateSpaceAction())->execute('Testing Space', 1, 1);

        $this->assertNotNull($space->id);
        $this->assertCount(1, $space->users);
    }
}
