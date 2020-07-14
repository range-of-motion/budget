<?php

namespace App\Http\Controllers;

use App\Models\Space;
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
}
