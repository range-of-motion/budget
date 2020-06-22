<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller
{
    public function create()
    {
        return view('ideas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:bug,feature_request',
            'body' => 'required'
        ]);

        Idea::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'body' => $request->body
        ]);

        return redirect()->route('ideas.create');
    }
}
