<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JurnalController;

// Endpoint Publik (Tanpa Token)
Route::post('/login', [AuthController::class, 'login']);

// Endpoint Terproteksi (Wajib Bearer Token Sanctum)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('jurnals', JurnalController::class);
});
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
