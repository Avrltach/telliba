<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokumenController;


Route::get('/dokumens', [DokumenController::class, 'index']);
Route::post('/dokumens', [DokumenController::class, 'store']);
Route::get('/dokumens/{id}', [DokumenController::class, 'show']);
Route::post('/dokumens/{id}', [DokumenController::class, 'update']);
Route::delete('/dokumens/{id}', [DokumenController ::class, 'destroy']);