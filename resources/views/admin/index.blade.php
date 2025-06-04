@extends('layouts.app')

@section('content')
@if(session('error') || session('success'))
    @php
        $type = session('error') ? 'error' : 'success';
        $message = session($type);
        $bgColor = $type === 'error' ? 'bg-red-500' : 'bg-green-500';
        $id = $type . 'Message';
        $closeFunction = 'close' . ucfirst($type) . 'Message';
    @endphp

    <div id="{{ $id }}" class="{{ $bgColor }} text-white p-4 rounded-lg mb-6 relative">
        <span>{{ $message }}</span>
        <button class="absolute right-5 text-white font-bold" onclick="{{ $closeFunction }}()">X</button>
    </div>

    <script>
       function {{ $closeFunction }}() {
    document.getElementById('{{ $id }}').classList.add('hidden');
}

       setTimeout(function() {
    var el = document.getElementById('{{ $id }}');
    if (el) el.classList.add('hidden');
}, 5000);

    </script>
@endif

<div class="bg-white p-6 rounded shadow mb-4">
    <h1 class="text-3xl font-semibold text-gray-800 mb-2">Manajemen Dokumen</h1>
    <p class="text-gray-700 mb-6">Selamat datang di halaman manajemen dokumen! Di sini Anda dapat menambah, mengedit, dan menghapus dokumen perusahaan.</p>

    <div class="mb-4">
        <a href="{{ route('admin.create') }}" class="bg-blue-600 text-white py-2 px-6 rounded-full shadow hover:bg-blue-700 transition duration-200">
            Tambah Dokumen
        </a>
    </div>
</div>

<div class="bg-white p-6 rounded shadow">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($dokumens as $dokumen)
            <div class="relative bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200 group">
                <div class="mb-2">
                    <h2 class="text-xl font-semibold text-gray-900">{{ $dokumen->title }}</h2>
                    <p class="text-sm text-gray-600">{{ $dokumen->category }}</p>
                </div>

                <p class="text-sm text-gray-700 mt-2 mb-2 text-justify">
                    {{ Str::limit($dokumen->description, 100) }}
                </p>

                <div class="mb-2">
                   <a href="{{ route('dokumen.view', $dokumen->id) }}" target="_blank" class="text-blue-600 hover:underline font-medium">
    Lihat Dokumen
</a>

                </div>

                <div class="flex justify-between items-center mt-4">
                    <a href="{{ route('admin.edit', $dokumen) }}" class="text-blue-600 hover:underline">Edit</a>
                    <form action="{{ route('admin.destroy', $dokumen) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-600 font-medium">
                Tidak Ada Dokumen yang Tersedia.
            </div>
        @endforelse
    </div>
</div>
@endsection
