<?php

namespace Tests\Feature;

use App\User;
use App\Space;
use App\Tag;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagTest extends TestCase {
    // Edit
    public function testAuthorizedUserCanEditTag() {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $user->spaces()->sync([$space->id]);

        $tag = factory(Tag::class)->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->get('/tags/' . $tag->id . '/edit');

        $response->assertStatus(200);
    }

    public function testUnauthorizedUserCantEditTag() {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $tag = factory(Tag::class)->create([
            'space_id' => $space->id
        ]);

        $this->actingAs($user);

        $response = $this->get('/tags/' . $tag->id . '/edit');

        $response->assertStatus(403);
    }

    // Update
    public function testUpdateTag() {
        $user = factory(User::class)->create();

        $space = factory(Space::class)->create();

        $user->spaces()->sync([$space->id]);

        $tag = factory(Tag::class)->create([
            'space_id' => $space->id,
            'name' => 'Before'
        ]);

        $this->actingAs($user);

        $this->patch('/tags/' . $tag->id, [
            'name' => 'After'
        ]);

        $this->assertEquals(Tag::find($tag->id)->name,'After');
    }
}
