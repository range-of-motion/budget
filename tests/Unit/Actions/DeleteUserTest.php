<?php

namespace Tests\Unit\Actions;

use App\Actions\DeleteUserAction;
use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    public function testUserNotFound(): void
    {
        $this->expectException(UserNotFoundException::class);

        (new DeleteUserAction())->execute(999);
    }

    public function testSuccessfulAvatarCleared(): void
    {
        $image = \Image::canvas(500, 500, '#CCC');

        Storage::put('public/avatars/yabadabadoo.png', (string) $image->encode());

        $user = factory(User::class)->create([
            'avatar' => 'yabadabadoo.png'
        ]);

        $this->assertFileExists(storage_path() . '/app/public/avatars/yabadabadoo.png');

        (new DeleteUserAction())->execute($user->id);

        $this->assertFileNotExists(storage_path() . '/app/public/avatars/yabadabadoo.png');
    }

    public function testSuccessfulColumnsCleared(): void
    {
        $user = factory(User::class)->create([
            'name' => 'John Doe',
            'email' => 'jdoe@gmail.com'
        ]);

        $this->assertNotNull($user->name);
        $this->assertNotNull($user->email);

        (new DeleteUserAction())->execute($user->id);

        $user->refresh();

        $this->assertNull($user->name);
        $this->assertNull($user->email);
    }
}
