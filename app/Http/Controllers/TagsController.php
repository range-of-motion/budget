<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tag;

class TagsController extends Controller {
    public function index() {
        $tags = Auth::user()->tags;

        return view('tags.index', compact('tags'));
    }

    public function create() {
        return view('tags.create');
    }

    public function store(Request $request) {
        $tag = new Tag;

        $tag->user_id = Auth::user()->id;
        $tag->name = $request->name;

        $tag->save();

        return redirect('/tags');
    }

    public function edit(Tag $tag) {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag) {
        $tag->name = $request->input('name');

        $tag->save();

        return redirect()->route('tags');
    }

    public function destroy($id) {
        $tag = Tag::find($id);

        $tag->delete();

        return redirect()->route('tags');
    }
}
