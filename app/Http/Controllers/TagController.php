<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tag;

class TagController extends Controller {
    public function index() {
        return view('tags.index', [
            'tags' => Auth::user()->tags()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function create() {
        return view('tags.create');
    }

    public function store(Request $request) {
        $tag = new Tag;

        $tag->user_id = Auth::user()->id;
        $tag->name = $request->name;

        $tag->save();

        return redirect('/settings');
    }

    public function edit(Tag $tag) {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag) {
        $request->validate([
            'name' => 'required|max:255'
        ]);

        $tag->name = $request->input('name');
        $tag->save();

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag) {
        if (!$tag->spendings->count()) {
            $tag->delete();
        }

        return redirect('/settings');
    }
}
