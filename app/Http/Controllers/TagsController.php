<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use App\Tags;

class TagsController extends Controller {
    public function index() {
        $tags = Auth::user()->tags;

        return view('tags.index', compact('tags'));
    }
}
