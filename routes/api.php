<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\VoitureController;
use App\Http\Controllers\MarqueController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // User
    Route::post('/logout', [UserController::class, 'logout']);
});


// Public routes
// User
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

// Voiture
Route::apiResource('/voitures', VoitureController::class);
//Route::get('/voitures', [VoitureController::class, 'index']);

// Marque
Route::apiResource('/marques', MarqueController::class);
// Route::get('/marques', [MarqueController::class, 'index']);