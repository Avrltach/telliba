<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dokumen;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::latest()->get();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Data dokumen berhasil diambil.',
                'data' => $dokumens
            ], 200);
        }

        return view('admin.index', compact('dokumens'));
    }

    public function create()
    {
        return view('admin.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'file_path' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $path = $request->file('file_path')->store('dokumen', 'public');

        $dokumen = Dokumen::create([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'file_path' => $path,
        ]);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen berhasil ditambahkan.',
                'data' => $dokumen
            ], 201);
        }

        return redirect()->route('admin.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        return view('admin.edit', compact('dokumen'));
    }

    public function update(Request $request, $id)
    {
        $dokumen = Dokumen::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'file_path' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('file_path')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            $dokumen->file_path = $request->file('file_path')->store('dokumen', 'public');
        }

        $dokumen->update([
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category,
            'file_path' => $dokumen->file_path,
        ]);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen berhasil diperbarui.',
                'data' => $dokumen
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'message' => 'Dokumen berhasil dihapus.'
            ]);
        }

        return redirect()->route('admin.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    public function show($id)
    {
        $dokumen = Dokumen::findOrFail($id);

        if (request()->wantsJson()) {
            return response()->json([
                'status' => 'success',
                'data' => $dokumen
            ]);
        }

        return view('dokumens.show', compact('dokumen'));
    }

    public function viewFile($id)
    {
        $dokumen = Dokumen::findOrFail($id);
        $path = storage_path('app/public/' . $dokumen->file_path);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
