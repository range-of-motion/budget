<?php

namespace App\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use App\Models\Widget;

class CreateDefaultWidgetsAction
{
    public function execute(int $userId): void
    {
        $user = User::find($userId);

        if (!$user) {
            throw new UserNotFoundException();
        }

        Widget::create([
            'user_id' => $user->id,
            'type' => 'balance',
            'sorting_index' => 0,
            'properties' => []
        ]);

        Widget::create([
            'user_id' => $user->id,
            'type' => 'spent',
            'sorting_index' => 1,
            'properties' => ['period' => 'today']
        ]);

        Widget::create([
            'user_id' => $user->id,
            'type' => 'spent',
            'sorting_index' => 2,
            'properties' => ['period' => 'this_month']
        ]);
    }
}
