<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('/auth/login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard user biasa
    Route::get('/dashboard', [HomeController::class, 'userDashboard'])->name('dashboard');

    // Dashboard admin
    Route::get('/admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
});

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin dashboard 
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    
    // Dokumen routes (CRUD)
    Route::get('/dokumens', [DokumenController::class, 'index'])->name('dokumens.index');
    Route::get('/dokumens/create', [DokumenController::class, 'create'])->name('dokumens.create');
    Route::post('/dokumens', [DokumenController::class, 'store'])->name('dokumens.store');
    Route::get('/dokumens/{dokumen}', [DokumenController::class, 'show'])->name('dokumens.show');
    Route::get('/dokumens/{dokumen}/edit', [DokumenController::class, 'edit'])->name('dokumens.edit');
    Route::put('/dokumens/{dokumen}', [DokumenController::class, 'update'])->name('dokumens.update');
    Route::delete('/dokumens/{dokumen}', [DokumenController::class, 'destroy'])->name('dokumens.destroy');
    Route::get('/dokumens/{dokumen}/download', [DokumenController::class, 'download'])->name('dokumens.download');

    // Category routes 
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

    // User routes (
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

require __DIR__.'/auth.php';
