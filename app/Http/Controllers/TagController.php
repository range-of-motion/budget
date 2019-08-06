<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tag;
use Illuminate\Support\Facades\Validator;

class TagController extends Controller {
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'max:255',
            'color' => 'required', 'max:6'
        ]);
    }

    protected function updateValidator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'max:255'
        ]);
    }

    public function index() {
        return view('tags.index', [
            'tags' => session('space')->tags()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function create() {
        return view('tags.create');
    }

    public function store(Request $request) {
        $this->validator($request->all())->validate();

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

        $this->updateValidator($request->all())->validate();

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
