<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\User;
use App\Models\Category;

class DokumenController extends Controller
{
    // Tampilkan semua dokumen
    public function index()
    {
        $dokumens = Dokumen::with(['user', 'category'])->get();
        return view('dokumen.index', compact('dokumens'));
    }

    // Tampilkan form untuk membuat dokumen baru
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('dokumen.create', compact('users', 'categories'));
    }

    // Simpan dokumen baru ke database
    public function store(Request $request)
    {
        $request->validate([
            'UserID' => 'required|exists:users,UserID',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
        ]);

        Dokumen::create($request->all());

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    // Tampilkan detail dokumen
    public function show($id)
    {
        $dokumen = Dokumen::with(['user', 'category'])->findOrFail($id);
        return view('dokumen.show', compact('dokumen'));
    }

    // Tampilkan form edit dokumen
    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $users = User::all();
        $categories = Category::all();
        return view('dokumen.edit', compact('dokumen', 'users', 'categories'));
    }

    // Update dokumen
    public function update(Request $request, $id)
    {
        $request->validate([
            'UserID' => 'required|exists:users,UserID',
            'CategoryID' => 'required|exists:categories,CategoryID',
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
        ]);

        $dokumen = Dokumen::findOrFail($id);
        $dokumen->update($request->all());

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diupdate.');
    }

    // Hapus dokumen
    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
