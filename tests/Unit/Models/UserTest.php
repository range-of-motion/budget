<?php

namespace Tests\Unit\Models;

use App\Models\User;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function testAvatarAttribute(): void
    {
        $userWithoutAvatar = User::factory()
            ->create([
                'avatar' => null,
            ]);

        $this->assertEquals('https://via.placeholder.com/250', $userWithoutAvatar->avatar);

        $userWithAvatar = User::factory()
            ->create([
                'avatar' => 'foo.png',
            ]);

        $this->assertEquals('/storage/avatars/foo.png', $userWithAvatar->avatar);
    }
}
