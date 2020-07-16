<?php

namespace App\Http\Controllers;

use App\Actions\CreateSpaceInviteAction;
use App\Exceptions\SpaceInviteAlreadyExistsException;
use App\Exceptions\SpaceInviteInviteeAlreadyPresentException;
use App\Models\Space;
use App\Models\SpaceInvite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{
    public function show($id)
    {
        $space = Space::find($id);

        if ($space->users->contains(Auth::user()->id)) {
            session(['space' => $space]);
        }

        return redirect()->route('dashboard');
    }

    public function edit(Space $space)
    {
        if (Auth::user()->cant('edit', $space)) {
            return redirect()->route('settings.spaces.index');
        }

        return view('spaces.edit', ['space' => $space]);
    }

    public function update(Request $request, Space $space)
    {
        if (Auth::user()->cant('edit', $space)) {
            return redirect()->route('settings.spaces.index');
        }

        $request->validate([
            'name' => 'required|max:255'
        ]);

        $space->fill([
            'name' => $request->name
        ])->save();

        return redirect()->route('settings.spaces.index');
    }

    public function invite(Request $request, Space $space)
    {
        $authenticatedUser = Auth::user();

        if ($authenticatedUser->cant('edit', $space)) {
            return redirect()->route('settings.spaces.index');
        }

        $request->validate([
            'email' => 'required|exists:users,email',
            'role' => 'required|in:admin,regular'
        ]);

        $inviteeUser = User::where('email', $request->email)->first();

        try {
            (new CreateSpaceInviteAction())->execute(
                $space->id,
                $inviteeUser->id,
                $authenticatedUser->id,
                $request->role
            );
        } catch (SpaceInviteInviteeAlreadyPresentException $e) {
            return redirect()
                ->route('spaces.edit', ['space' => $space->id])
                ->with('inviteStatus', 'present');
        } catch (SpaceInviteAlreadyExistsException $e) {
            return redirect()
                ->route('spaces.edit', ['space' => $space->id])
                ->with('inviteStatus', 'exists');
        }

        // TODO SEND MAIL

        return redirect()
            ->route('spaces.edit', ['space' => $space->id])
            ->with('inviteStatus', 'success');
    }
}
