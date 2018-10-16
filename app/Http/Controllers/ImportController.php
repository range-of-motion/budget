<?php

namespace App\Http\Controllers;

use App\Import;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImportController extends Controller {
    public function index() {
        return view('imports.index')->with([
            'imports' => session('space')->imports()->orderBy('created_at', 'DESC')->get()
        ]);
    }

    public function create() {
        return view('imports.create');
    }

    public function store(Request $request) {
        $request->validate([
            'name' => 'required|max:255',
            'file' => 'required' // TODO VALIDATE CSV
        ]);

        $path = $request->file('file')->store('imports');
        $pathParts = explode('/', $path);

        Import::create([
            'space_id' => session('space')->id,
            'name' => $request->input('name'),
            'file' => end($pathParts)
        ]);

        return redirect()->route('imports.index');
    }

    public function getPrepare(Import $import) {
        // TODO AUTHORIZE

        $headers = [];

        $file = fopen(storage_path('app/imports/' . $import->file), 'r');

        while ($row = fgetcsv($file, 999, ',')) {
            foreach ($row as $column) {
                $headers[] = $column;
            }

            break;
        }

        return view('imports.prepare', compact('headers'));
    }

    public function postPrepare(Request $request, Import $import) {
        // TODO AUTHORIZE

        // TODO VALIDATE

        $import->fill([
            'column_happened_on' => $request->input('column_happened_on'),
            'column_description' => $request->input('column_description'),
            'column_amount' => $request->input('column_amount'),
            'status' => 1
        ])->save();

        return redirect()->route('imports.index');
    }
}
