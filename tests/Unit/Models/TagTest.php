<?php

namespace Tests\Unit\Models;

use App\Repositories\TagRepository;
use App\Models\Space;
use App\Models\Spending;
use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    public function testMostExpensiveTags()
    {
        $space = Space::factory()->create();

        $repository = new TagRepository();

        // No tags existing
        $this->assertEmpty($repository->getMostExpensiveTags($space->id));

        $tag = Tag::factory()->create([
            'space_id' => $space->id
        ]);

        // After creating tag
        $this->assertNotEmpty($repository->getMostExpensiveTags($space->id));
        $this->assertEquals(0, $repository->getMostExpensiveTags($space->id)[0]->amount);

        // After creating spending for said tag
        Spending::factory()->create([
            'space_id' => $space->id,
            'tag_id' => $tag->id,
            'amount' => 1025
        ]);

        $this->assertEquals(1025, $repository->getMostExpensiveTags($space->id)[0]->amount);

        // TODO TEST YEAR, MONTH AND LIMIT
    }
}
