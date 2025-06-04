@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-gray-800 mb-6">Edit Dokumen</h1>

    <form action="{{ route('admin.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        {{-- Judul Dokumen --}}
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-medium mb-2">Judul Dokumen</label>
            <input type="text" name="title" id="title" value="{{ $dokumen->title }}" placeholder="Masukkan Judul Dokumen" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Kategori --}}
        <div class="mb-4">
            <label for="category" class="block text-gray-700 text-sm font-medium mb-2">Kategori</label>
            <input type="text" name="category" id="category" value="{{ $dokumen->category }}" placeholder="Masukkan Kategori (Contoh: Keuangan, SDM)" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        </div>

        {{-- Deskripsi --}}
        <div class="mb-4">
            <label for="description" class="block text-gray-700 text-sm font-medium mb-2">Deskripsi Dokumen</label>
            <textarea name="description" id="description" rows="5" placeholder="Masukkan Deskripsi Dokumen" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ $dokumen->description }}</textarea>
        </div>

        {{-- Upload File --}}
        <div class="mb-4">
            <label for="file_path" class="block text-gray-700 text-sm font-medium mb-2">Unggah Dokumen Baru (Opsional)</label>
            <input type="file" name="file_path" id="file_path" accept=".pdf,.doc,.docx" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        </div>

        {{-- File saat ini --}}
        @if($dokumen->file_path)
            <div class="mb-6">
                <p class="text-sm text-gray-500">Dokumen Saat Ini:</p>
                <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" class="text-blue-600 underline">{{ basename($dokumen->file_path) }}</a>
            </div>
        @endif

        {{-- Tombol --}}
        <div class="flex justify-start items-center mt-6 p-2 space-x-4">
            <a href="{{ route('admin.index') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-400 transition duration-300">
                Kembali
            </a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600 transition duration-300">
                Update Dokumen
            </button>
        </div>
    </form>
</div>
@endsection
