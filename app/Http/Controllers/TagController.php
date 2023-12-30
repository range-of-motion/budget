<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;
use App\Repositories\TagRepository;

class TagController extends Controller
{
    private $tagRepository;

    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }

    public function index()
    {
        $tags = Tag::query()
            ->where('space_id', session('space_id'))
            ->latest()
            ->get();

        return view('tags.index', ['tags' => $tags]);
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(Request $request)
    {
        $request->validate($this->tagRepository->getValidationRules());

        $this->tagRepository->create(session('space_id'), $request->input('name'), $request->input('color'));

        return redirect()->route('tags.index');
    }

    public function edit(Tag $tag)
    {
        $this->authorize('edit', $tag);

        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $this->authorize('update', $tag);

        // phpcs:ignore
        $request->validate(array_slice($this->tagRepository->getValidationRules(), 0, 1, true)); // Get rid of last entry in $validationRules as it's not required for updating

        $this->tagRepository->update($tag->id, [
            'name' => $request->input('name'),
            'color' => $request->input('color')
        ]);

        return redirect()->route('tags.index');
    }

    public function destroy(Tag $tag)
    {
        $this->authorize('delete', $tag);

        if (!$tag->spendings->count()) {
            $tag->delete();
        }

        return redirect()->route('tags.index');
    }
}
