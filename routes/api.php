<?php

use App\Http\Controllers\Api\LogInController;
use Illuminate\Support\Facades\Route;

Route::post('/log-in', LogInController::class);
