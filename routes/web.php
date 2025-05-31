<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [HomeController::class, 'index'])->middleware(['auth'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/dokumens/{dokumen}', [DokumenController::class, 'show'])->name('dokumens.show');

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function() {
    Route::get('/dokumens',[DokumenController::class, 'index'])->name('admin.index');
    Route::get('/dokumens/create',[DokumenController::class, 'create'])->name('admin.create');
    Route::post('/dokumens',[DokumenController::class, 'store'])->name('admin.store');
    Route::get('/dokumens/{dokumen}/edit',[DokumenController::class, 'edit'])->name('admin.edit');
    Route::put('/dokumens/{dokumen}',[DokumenController::class,'update'])->name('admin.update');
    Route::delete('/dokumens/{dokumen}',[DokumenController::class,'destroy'])->name('admin.destroy');
});

Route::get('admin/dashboard', [HomeController::class, 'index']);
