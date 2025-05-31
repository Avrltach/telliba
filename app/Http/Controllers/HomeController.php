<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;

class HomeController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::latest()->get();
        return view('admin.dashboard', compact('dokumens'));
    }
}
