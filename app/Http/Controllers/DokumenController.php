<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = auth()->user()->role === 'admin'
            ? Dokumen::with('category', 'user')->latest()->get()
            : Dokumen::with('category')->where('UserID', auth()->id())->latest()->get();

        return view('dokumen.index', compact('dokumens'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('dokumen.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'CategoryID' => 'required|exists:categories,id',
            'file' => 'required|file|mimes:pdf,docx|max:2048',
        ]);

        $path = $request->file('file')->store('dokumen', 'public');

        Dokumen::create([
            'UserID' => auth()->id(),
            'CategoryID' => $request->CategoryID,
            'Title' => $request->Title,
            'Description' => $request->Description,
            'FilePath' => $path,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $categories = Category::all();

        if (auth()->user()->role !== 'admin' && $dokumen->UserID !== auth()->id()) {
            abort(403, 'Tidak memiliki izin.');
        }

        return view('dokumen.edit', compact('dokumen', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $dokumen->UserID !== auth()->id()) {
            abort(403, 'Tidak memiliki izin.');
        }

        $request->validate([
            'Title' => 'required|string|max:255',
            'Description' => 'nullable|string',
            'CategoryID' => 'required|exists:categories,id',
            'file' => 'nullable|file|mimes:pdf,docx|max:2048',
        ]);

        // Ganti file jika ada
        if ($request->hasFile('file')) {
            if ($dokumen->FilePath && Storage::disk('public')->exists($dokumen->FilePath)) {
                Storage::disk('public')->delete($dokumen->FilePath);
            }

            $dokumen->FilePath = $request->file('file')->store('dokumen', 'public');
        }

        $dokumen->update([
            'Title' => $request->Title,
            'Description' => $request->Description,
            'CategoryID' => $request->CategoryID,
            'FilePath' => $dokumen->FilePath,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $dokumen->UserID !== auth()->id()) {
            abort(403, 'Tidak memiliki izin.');
        }

        if ($dokumen->FilePath && Storage::disk('public')->exists($dokumen->FilePath)) {
            Storage::disk('public')->delete($dokumen->FilePath);
        }

        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}
