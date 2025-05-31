@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="bg-white p-6 rounded shadow-md">
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">{{ $dokumen->judul }}</h1>
            <p class="text-sm text-gray-500 mt-1">
                Diupload pada: {{ $dokumen->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}
            </p>
        </div>

        @if ($dokumen->file)
            <div class="mb-6">
                <label class="block text-gray-700 font-medium mb-2">Preview Dokumen:</label>
                <embed src="{{ asset('storage/' . $dokumen->file) }}" type="application/pdf" class="w-full h-[600px] rounded border" />
            </div>
        @endif

        <div class="mb-6">
            <label class="block text-gray-700 font-medium mb-2">Deskripsi:</label>
            <p class="text-gray-700 text-justify">{{ $dokumen->deskripsi }}</p>
        </div>

        <div class="flex items-center space-x-4">
            <a href="{{ route('dokumen.dashboard') }}" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500 transition">Kembali</a>
            @auth
                @if (auth()->user()->role === 'admin')
                    <a href="{{ route('dokumen.edit', $dokumen->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Edit</a>
                @endif
            @endauth
        </div>
    </div>
</div>
@endsection
