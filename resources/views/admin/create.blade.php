@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Unggah Dokumen Baru</h1>

    <form method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf

        {{-- Judul Dokumen --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Judul Dokumen</label>
            <input type="text" name="title" id="title" placeholder="Masukkan Judul Dokumen" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="category" class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
            <input type="text" name="category" id="category" placeholder="Contoh: Keuangan, SDM, Akademik" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Deskripsi Dokumen</label>
            <textarea name="description" id="description" rows="5" placeholder="Masukkan Deskripsi Singkat Dokumen" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
        </div>

        {{-- Upload Dokumen --}}
        <div class="mb-4">
            <label for="file_path" class="block text-gray-700 text-sm font-medium mb-2">Unggah File Dokumen (PDF/DOCX)</label>
            <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Tombol --}}
        <div class="flex justify-start items-center mt-6 p-2 space-x-4">
            <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-400 transition duration-300">
                Kembali
            </a>
            <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-full hover:bg-green-700 transition duration-300">
                Simpan Dokumen
            </button>
        </div>
    </form>
</div>
@endsection
