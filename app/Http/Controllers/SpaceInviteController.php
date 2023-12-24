<?php

namespace App\Http\Controllers;

use App\Actions\AcceptSpaceInviteAction;
use App\Actions\DenySpaceInviteAction;
use App\Models\Space;
use App\Models\SpaceInvite;
use Illuminate\Http\Request;

class SpaceInviteController extends Controller
{
    public function show(Request $request, Space $space, SpaceInvite $invite)
    {
        if ($invite->space->id !== $space->id) {
            abort(404);
        }

        $this->authorize('access', $invite);

        if ($invite->accepted !== null) {
            abort(410);
        }

        return view('space_invites.show', [
            'invite' => $invite
        ]);
    }

    public function accept(Request $request, Space $space, SpaceInvite $invite)
    {
        if ($invite->space->id !== $space->id) {
            abort(404);
        }

        $this->authorize('access', $invite);

        if ($invite->accepted !== null) {
            abort(410);
        }

        (new AcceptSpaceInviteAction())->execute($invite->id);

        return redirect()->route('settings.spaces.index');
    }

    public function deny(Request $request, Space $space, SpaceInvite $invite)
    {
        if ($invite->space->id !== $space->id) {
            abort(404);
        }

        $this->authorize('access', $invite);

        if ($invite->accepted !== null) {
            abort(410);
        }

        (new DenySpaceInviteAction())->execute($invite->id);

        return redirect()->route('settings.spaces.index');
    }
}
