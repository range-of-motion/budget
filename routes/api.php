<?php

use App\Http\Controllers\Api\ActivitiesController;
use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\Api\LogInController;
use App\Http\Controllers\Api\RecurringController;
use App\Http\Controllers\Api\SettingsController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/log-in', LogInController::class);

Route::middleware('resolve-api-key')
    ->group(function () {
        Route::get('/dashboard', DashboardController::class);

        Route::resource('transactions', TransactionController::class)
            ->only(['index', 'store']);

        Route::resource('recurrings', RecurringController::class)
            ->only(['store']);

        Route::resource('tags', TagController::class)
            ->only(['index']);

        Route::get('/activities', ActivitiesController::class);

        Route::resource('settings', SettingsController::class)
            ->only(['index', 'store']);
    });
