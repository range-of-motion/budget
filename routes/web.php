<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LogInController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', IndexController::class)->name('index');

Route::get('/log-in', [LogInController::class, 'index'])->name('log-in');

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::get('/dashboard', DashboardController::class)->name('dashboard');
