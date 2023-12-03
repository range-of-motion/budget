<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TagResource;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(Request $request)
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        return TagResource::collection($apiKey->user->spaces()->first()->tags);
    }
}
