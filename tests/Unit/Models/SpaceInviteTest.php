<?php

namespace Tests\Unit\Models;

use App\Models\SpaceInvite;
use Tests\TestCase;

class SpaceInviteTest extends TestCase
{
    public function testStatusAttribute(): void
    {
        $pendingSpaceInvite = SpaceInvite::factory()
            ->make([
                'accepted' => null,
            ]);

        $this->assertEquals('Pending', $pendingSpaceInvite->status);

        $acceptedSpaceInvite = SpaceInvite::factory()
            ->make([
                'accepted' => true,
            ]);

        $this->assertStringStartsWith('Accepted', $acceptedSpaceInvite->status);

        $deniedSpaceInvite = SpaceInvite::factory()
            ->make([
                'accepted' => false,
            ]);

        $this->assertStringStartsWith('Denied', $deniedSpaceInvite->status);
    }
}
