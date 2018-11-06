<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;

class IdeaController extends Controller {
    public function create() {
        return view('ideas.create');
    }

    public function store(Request $request) {
        $request->validate([
            'body' => 'required'
        ]);

        Idea::create([
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return redirect()->route('ideas.create');
    }
}
