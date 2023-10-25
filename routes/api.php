<?php

use App\Http\Controllers\Api\LogInController;
use App\Http\Controllers\Api\TransactionController;
use Illuminate\Support\Facades\Route;

Route::post('/log-in', LogInController::class);

Route::get('/transactions', [TransactionController::class, 'index']);
