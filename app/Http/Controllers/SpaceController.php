<?php

namespace App\Http\Controllers;

use App\Actions\CreateSpaceAction;
use App\Actions\CreateSpaceInviteAction;
use App\Actions\StoreSpaceInSessionAction;
use App\Exceptions\SpaceInviteAlreadyExistsException;
use App\Exceptions\SpaceInviteInviteeAlreadyPresentException;
use App\Mail\InvitedToSpace;
use App\Models\Currency;
use App\Models\Space;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SpaceController extends Controller
{
    public function create()
    {
        $currencies = Currency::all();

        return view('spaces.create', ['currencies' => $currencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'currency_id' => 'required|exists:currencies,id'
        ]);

        (new CreateSpaceAction())->execute($request->name, $request->currency_id, Auth::id());

        return redirect()->route('settings.spaces.index');
    }

    public function show($id)
    {
        $space = Space::find($id);

        if ($space->users->contains(Auth::user()->id)) {
            (new StoreSpaceInSessionAction())->execute($space->id);
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
            $invite = (new CreateSpaceInviteAction())->execute(
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

        Mail::to($inviteeUser->email)->send(new InvitedToSpace($invite));

        return redirect()
            ->route('spaces.edit', ['space' => $space->id])
            ->with('inviteStatus', 'success');
    }
}
