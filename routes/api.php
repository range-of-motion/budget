<?php

use App\Http\Controllers\Api\LogInController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/log-in', LogInController::class);

Route::middleware('resolve-api-key')
    ->group(function () {
        Route::resource('transactions', TransactionController::class)
            ->only(['index', 'store']);
    });
