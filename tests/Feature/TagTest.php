<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Space;
use App\Models\Tag;
use Tests\TestCase;

class TagTest extends TestCase
{
    // Edit
    public function testAuthorizedUserCanEditTag()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $user->spaces()->sync([$space->id]);

        $tag = Tag::factory()->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->get('/tags/' . $tag->id . '/edit');

        $response->assertStatus(200);
    }

    public function testUnauthorizedUserCantEditTag()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $tag = Tag::factory()->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->get('/tags/' . $tag->id . '/edit');

        $response->assertStatus(403);
    }

    // Update
    public function testUpdateTag()
    {
        $user = User::factory()->create();

        $space = Space::factory()->create();

        $user->spaces()->sync([$space->id]);

        $tag = Tag::factory()->create([
            'space_id' => $space->id,
            'name' => 'Before'
        ]);

        $this->actingAs($user);

        $this->patch('/tags/' . $tag->id, [
            'name' => 'After'
        ]);

        $this->assertEquals('After', Tag::find($tag->id)->name);
    }
}
