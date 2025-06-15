<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Dokumen;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    // Dashboard untuk admin
    public function index()
    {
        $user = Auth::user();

        if ($user->usertype != 'admin') {
            // Kalau bukan admin, redirect ke dashboard user biasa
            return redirect()->route('dashboard');
        }

        $dokumens = Dokumen::with('category')->paginate(10);
        $totalDokumen = Dokumen::count();
        $totalKategori = Category::count();
        $totalUser = User::count();

        return view('admin.dashboard', compact('dokumens', 'totalDokumen', 'totalKategori', 'totalUser'));
    }

    public function userDashboard()
{
    $user = Auth::user();

    if ($user->usertype != 'user') {
        return redirect()->route('dashboard');
    }

    $dokumens = Dokumen::with('category')->paginate(10);
    $totalDokumen = Dokumen::count();
    $totalKategori = Category::count();
    $totalUser = User::count();

    return view('users.dashboard', compact('dokumens', 'totalDokumen', 'totalKategori', 'totalUser'));
}

}
