<?php

use App\Http\Controllers\API\AuthenticateController;
use Illuminate\Http\Request;

Route::post('/authenticate', AuthenticateController::class);
