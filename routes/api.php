<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiUserController;
use App\Http\Controllers\Api\ApiDokumensController;
use App\Http\Controllers\Api\ApiCategoryController;

// ========== AUTH ========== //
Route::post('/register', [ApiUserController::class, 'register']);
Route::post('/login', [ApiUserController::class, 'login']);
Route::post('/logout', [ApiUserController::class, 'logout'])->middleware('auth:sanctum');

// ========== USER MANAGEMENT ========== //
Route::get('/users', [UserController::class, 'index'])->middleware('auth:sanctum');
Route::put('/users/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum');

// ========== DOKUMEN ========== //
Route::get('/dokumens', [ApiDokumensController::class, 'index']);
Route::get('/dokumens/{id}', [ApiDokumensController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/dokumens', [ApiDokumensController::class, 'store']);
    Route::put('/dokumens/{id}', [ApiDokumensController::class, 'update']);
    Route::delete('/dokumens/{id}', [ApiDokumensController::class, 'destroy']);
});

// ========== CATEGORY ========== //
Route::get('/categories', [ApiCategoryController::class, 'index']);
Route::get('/categories/{id}', [ApiCategoryController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/categories', [ApiCategoryController::class, 'store']);
    Route::put('/categories/{id}', [ApiCategoryController::class, 'update']);
    Route::delete('/categories/{id}', [ApiCategoryController::class, 'destroy']);
});
