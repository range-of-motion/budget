<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        return response()
            ->json([
                'language' => $apiKey->user->language,
                'theme' => $apiKey->user->theme,
            ]);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'language' => 'nullable|string|in:en,nl,dk,de,fr,pt,ru',
            'theme' => 'nullable|string|in:light,dark',
        ]);

        /** @var ApiKey $apiKey */
        $apiKey = $request->get('apiKey');

        if ($request->has('language')) {
            $apiKey->user()->update(['language' => $request->get('language')]);
        }

        if ($request->has('theme')) {
            $apiKey->user()->update(['theme' => $request->get('theme')]);
        }

        return response()
            ->json([
                'language' => $apiKey->user->language,
                'theme' => $apiKey->user->theme,
            ]);
    }
}
