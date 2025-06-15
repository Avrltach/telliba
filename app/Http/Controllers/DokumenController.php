<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\Category;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumenController extends Controller
{
    // Tampilkan list dokumen dengan pagination
    public function index()
    {
    // Ambil daftar dokumen beserta kategori
    $dokumens = Dokumen::with('category')->latest()->paginate(10);

    // Ambil jumlah dokumen dan kategori
    $totalDokumen = Dokumen::count();
    $totalKategori = Category::count();

    // Kirim data ke view
    return view('dokumens.index', compact('dokumens', 'totalDokumen', 'totalKategori'));
    }


    // Form tambah dokumen baru
    public function create()
    {
        $categories = Category::all();
        return view('dokumens.create', compact('categories'));
    }

    // Simpan dokumen baru
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'required|file|mimes:pdf,doc,docx,xls,xlsx,txt|max:2048',
        ]);

        // Simpan file di storage/app/public/dokumens
        $filePath = $request->file('file')->store('dokumens', 'public');

        Dokumen::create([
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'file_path'   => $filePath,
        ]);

        return redirect()->route('dokumens.index')->with('success', 'Dokumen berhasil disimpan.');
    }

    // Tampilkan detail dokumen
    public function show(Dokumen $dokumen)
    {
        $dokumen->load('category');
        return view('dokumens.show', compact('dokumen'));
    }

    // Form edit dokumen
    public function edit(Dokumen $dokumen)
    {
        $categories = Category::all();
        return view('dokumens.edit', compact('dokumen', 'categories'));
    }

    // Update dokumen
    public function update(Request $request, Dokumen $dokumen)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'file'        => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,txt|max:2048',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
        ];

        // Jika ada file baru, hapus file lama dan simpan yang baru
        if ($request->hasFile('file')) {
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }
            $data['file_path'] = $request->file('file')->store('dokumens', 'public');
        }

        $dokumen->update($data);

        return redirect()->route('dokumens.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    // Hapus dokumen
    public function destroy(Dokumen $dokumen)
    {
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            Storage::disk('public')->delete($dokumen->file_path);
        }

        $dokumen->delete();

        return redirect()->route('dokumens.index')->with('success', 'Dokumen berhasil dihapus.');
    }

    // (Optional) Download file dokumen
    public function download(Dokumen $dokumen)
    {
        if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
            return Storage::disk('public')->download($dokumen->file_path);
        }
        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}