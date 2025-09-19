<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('users', UserController::class)->only(['index', 'show', 'destroy']);
Route::prefix('user')->group(function () {
    Route::post('login', [LoginController::class, 'store']);
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [LoginController::class, 'logout']); 
    });    
});
