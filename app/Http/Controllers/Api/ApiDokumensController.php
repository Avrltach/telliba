<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dokumen;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiDokumensController extends Controller
{
    public function index()
    {
        $dokumens = Dokumen::with('category')->latest()->paginate(10);

        return response()->json([
            'status' => 'success',
            'data' => $dokumens
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'required|file|mimes:pdf,doc,docx,xls,xlsx,txt|max:2048',
        ]);

        $filePath = $request->file('file')->store('dokumens', 'public');

        $dokumens = Dokumen::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'file_path'   => $filePath,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen berhasil disimpan',
            'data' => $dokumens
        ], 201);
    }

    public function show($id)
{
    $dokumen = Dokumen::with('category')->findOrFail($id);

    return response()->json([
        'status' => 'success',
        'data' => $dokumen
    ]);
}


    public function update(Request $request, Dokumen $dokumens)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,txt|max:2048',
        ]);

        $data = $request->only(['title', 'description', 'category_id']);

        if ($request->hasFile('file')) {
            if ($dokumens->file_path && Storage::disk('public')->exists($dokumens->file_path)) {
                Storage::disk('public')->delete($dokumens->file_path);
            }
            $data['file_path'] = $request->file('file')->store('dokumens', 'public');
        }

        $dokumens->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen berhasil diperbarui',
            'data' => $dokumens
        ]);
    }

    public function destroy(Dokumen $dokumens)
    {
        if ($dokumens->file_path && Storage::disk('public')->exists($dokumens->file_path)) {
            Storage::disk('public')->delete($dokumens->file_path);
        }

        $dokumens->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Dokumen berhasil dihapus'
        ]);
    }

    public function download(Dokumen $dokumens)
    {
        if ($dokumens->file_path && Storage::disk('public')->exists($dokumens->file_path)) {
            return Storage::disk('public')->download($dokumens->file_path);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'File tidak ditemukan'
        ], 404);
    }
}
