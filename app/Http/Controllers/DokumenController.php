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
            ? Dokumen::with('category')->get()
            : Dokumen::where('UserID', auth()->id())->with('category')->get();

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
            'Title' => 'required',
            'Description' => 'nullable',
            'CategoryID' => 'required',
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
            abort(403);
        }

        return view('dokumen.edit', compact('dokumen', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (auth()->user()->role !== 'admin' && $dokumen->UserID !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'Title' => 'required',
            'Description' => 'nullable',
            'CategoryID' => 'required',
            'file' => 'nullable|file|mimes:pdf,docx|max:2048',
        ]);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dokumen->FilePath);
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
            abort(403);
        }

        Storage::disk('public')->delete($dokumen->FilePath);
        $dokumen->delete();

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil dihapus.');
    }
}

