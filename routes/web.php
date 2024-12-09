<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoggerController;

Route::get('/log', [LoggerController::class, 'log']);
Route::get('/log-to/{type}', [LoggerController::class, 'logTo']);
Route::get('/log-to-all', [LoggerController::class, 'logToAll']);
