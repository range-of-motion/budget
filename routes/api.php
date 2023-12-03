<?php

use App\Http\Controllers\Api\LogInController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/log-in', LogInController::class);

Route::middleware('resolve-api-key')
    ->group(function () {
        Route::resource('transactions', TransactionController::class)
            ->only(['index', 'store']);

        Route::resource('tags', TagController::class)
            ->only(['index']);

        Route::resource('settings', SettingsController::class)
            ->only(['index', 'store']);
    });
