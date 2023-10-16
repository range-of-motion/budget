<?php

namespace Tests\Unit\Models;

use App\Models\SpaceInvite;
use Carbon\Carbon;
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
                'updated_at' => Carbon::parse('2021-02-14'),
            ]);

        $this->assertEquals('Accepted (14-02)', $acceptedSpaceInvite->status);

        $deniedSpaceInvite = SpaceInvite::factory()
            ->make([
                'accepted' => false,
                'updated_at' => Carbon::parse('2021-02-14'),
            ]);

        $this->assertEquals('Denied (14-02)', $deniedSpaceInvite->status);
    }
}
