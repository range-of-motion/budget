<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Models\Tag;

class TagController extends Controller {
    private $validationRules = [
        'name' => 'required|max:255',
        'color' => 'required|max:6'
    ];

    public function index() {
        return view('tags.index', [
            'tags' => session('space')->tags()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function create() {
        return view('tags.create');
    }

    public function store(Request $request) {
        $request->validate($this->validationRules);

        Tag::create([
            'space_id' => session('space')->id,
            'name' => $request->input('name'),
            'color' => $request->input('color')
        ]);

        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag) {
        $this->authorize('edit', $tag);

        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag) {
        $this->authorize('update', $tag);

        $request->validate(array_slice($this->validationRules, 0, 1, true)); // Get rid of last entry in $validationRules as it's not required for updating

        $tag->fill([
            'name' => $request->input('name'),
            'color' => $request->input('color')
        ])->save();

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag) {
        $this->authorize('delete', $tag);

        if (!$tag->spendings->count()) {
            $tag->delete();
        }

        return redirect()->route('tags.index');
    }
}
