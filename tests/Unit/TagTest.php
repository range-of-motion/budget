<?php

namespace Tests\Unit;

use App\Repositories\TagRepository;
use App\Space;
use App\Spending;
use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase {
    public function testMostExpensiveTags() {
        $space = factory(Space::class)->create();

        $repository = new TagRepository();

        // No tags existing
        $this->assertEmpty($repository->getMostExpensiveTags($space->id));

        $tag = factory(Tag::class)->create([
            'space_id' => $space->id
        ]);

        // After creating tag
        $this->assertNotEmpty($repository->getMostExpensiveTags($space->id));
        $this->assertEquals(0, $repository->getMostExpensiveTags($space->id)[0]->amount);

        // After creating spending for said tag
        factory(Spending::class)->create([
            'space_id' => $space->id,
            'tag_id' => $tag->id,
            'amount' => 1025
        ]);

        $this->assertEquals(1025, $repository->getMostExpensiveTags($space->id)[0]->amount);

        // TODO TEST YEAR, MONTH AND LIMIT
    }
}
