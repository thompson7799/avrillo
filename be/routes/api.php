<?php

use App\Http\Controllers\Api;
use Illuminate\Support\Facades\Route;

Route::post('register', [Api\AuthController::class, 'register']);
Route::post('login', [Api\AuthController::class, 'login']);

Route::middleware(['auth:sanctum', 'ability:access-api'])->group(function () {
    Route::get('ye-quotes', [Api\YeQuotesController::class, 'index']);
});
