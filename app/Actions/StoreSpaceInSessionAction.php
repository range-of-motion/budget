<?php

namespace App\Actions;

class StoreSpaceInSessionAction
{
    public function execute(int $spaceId): void
    {
        session(['space_id' => $spaceId]);
    }
}
