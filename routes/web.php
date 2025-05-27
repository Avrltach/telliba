<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DokumenController;



Route::resource('dokumen', DokumenController::class);

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// Batasi akses dashboard
Route::get('/dashboard', function () {
    if (!session()->has('user')) {
        return redirect()->route('login');
    }
    return view('dashboard');
})->name('dashboard');