<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\AuthController;



Route::get('/dokumens', [DokumenController::class, 'index']);
Route::post('/dokumens', [DokumenController::class, 'store']);
Route::get('/dokumens/{id}', [DokumenController::class, 'show']);
Route::put('/dokumens/{id}', [DokumenController::class, 'update']);
Route::delete('/dokumens/{id}', [DokumenController::class, 'destroy']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

