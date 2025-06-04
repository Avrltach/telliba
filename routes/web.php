<?php

use App\Http\Controllers\DokumenController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dokumens/{dokumen}', [DokumenController::class, 'show'])->name('dokumens.show');
Route::get('/dokumen/view/{id}', [DokumenController::class, 'viewFile'])->name('dokumen.view');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dokumens', [DokumenController::class, 'index'])->name('admin.index');
    Route::get('/dokumens/create', [DokumenController::class, 'create'])->name('admin.create');
    Route::post('/dokumens', [DokumenController::class, 'store'])->name('admin.store');
    Route::get('/dokumens/{dokumen}/edit', [DokumenController::class, 'edit'])->name('admin.edit');
    Route::put('/dokumens/{dokumen}', [DokumenController::class, 'update'])->name('admin.update');
    Route::delete('/dokumens/{dokumen}', [DokumenController::class, 'destroy'])->name('admin.destroy');
});
