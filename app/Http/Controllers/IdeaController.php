<?php

namespace App\Http\Controllers;

use App\Idea;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class IdeaController extends Controller {
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'type' => 'required', 'in:bug,feature_request',
            'body' => 'required'
        ]);
    }

    public function create() {
        return view('ideas.create');
    }

    public function store(Request $request) {
        $this->validator($request->all())->validate();

        Idea::create([
            'user_id' => auth()->user()->id,
            'type' => $request->type,
            'body' => $request->body
        ]);

        return redirect()->route('ideas.create');
    }
}
