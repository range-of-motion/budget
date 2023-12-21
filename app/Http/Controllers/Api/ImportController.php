<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImportResource;
use App\Models\Import;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function index(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        $imports = Import::query()
            ->where('space_id', $apiKey->user->spaces()->first()->id)
            ->latest()
            ->get();

        return ImportResource::collection($imports);
    }
}
