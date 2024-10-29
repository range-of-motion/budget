<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\LogOutController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::get('/log-in', [LogInController::class, 'index'])->name('log-in');
Route::post('/log-in', [LogInController::class, 'store']);

Route::get('/log-out', LogOutController::class)->name('log-out');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', DashboardController::class)->name('dashboard');
