<?php

namespace App\Http\Controllers;

use App\Import;
use App\Spending;
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
            'file' => 'required|size:200' // TODO VALIDATE CSV
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
        $this->authorize('modify', $import);

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
        $this->authorize('modify', $import);

        $request->validate([
            'column_happened_on' => 'required|integer',
            'column_description' => 'required|integer',
            'column_amount' => 'required|integer',
        ]);

        $import->fill([
            'column_happened_on' => $request->input('column_happened_on'),
            'column_description' => $request->input('column_description'),
            'column_amount' => $request->input('column_amount'),
            'status' => 1
        ])->save();

        return redirect()->route('imports.index');
    }

    public function getComplete(Import $import) {
        $this->authorize('modify', $import);

        $file = fopen(storage_path('app/imports/' . $import->file), 'r');

        $heading = true;
        $rows = [];

        while ($row = fgetcsv($file, 999, ',')) {
            if (!$heading) {
                $rows[] = [
                    'happened_on' => $row[$import->column_happened_on],
                    'description' => $row[$import->column_description],
                    'amount' => $row[$import->column_amount]
                ];
            }

            $heading = false;
        }

        return view('imports.complete', compact('rows'));
    }

    public function postComplete(Request $request, Import $import) {
        $this->authorize('modify', $import);

        // TODO WRITE CUSTOM VALIDATION FOR REQUIRED_WITH ROWS.*.IMPORT
        $request->validate([
            'rows.*.happened_on' => 'required|date|date_format:Y-m-d',
            'rows.*.description' => 'required|max:255',
            'rows.*.amount' => 'required|regex:/^\d*(\.\d{2})?$/'
        ]);

        foreach ($request->input('rows') as $row) {
            if (isset($row['import'])) {
                Spending::create([
                    'space_id' => session('space')->id,
                    'import_id' => $import->id,
                    'happened_on' => $row['happened_on'],
                    'description' => $row['description'],
                    'amount' => (int) ($row['amount'] * 100)
                ]);
            }
        }

        $import->fill([
            'status' => 2
        ])->save();

        return redirect()->route('imports.index');
    }
}
