<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\Auth\RegisterController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');


//Public routes for home
Route::apiResource('/posts', HomeController::class)->only(['index', 'show']); 

//Routes for user
Route::prefix('user')->group(function () {
    Route::post('login', [LoginController::class, 'store']);
    Route::post('register', [RegisterController::class, 'store']);
    
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('/posts', PostController::class); 

        Route::post('logout', [LoginController::class, 'logout']); 
    });    
});
