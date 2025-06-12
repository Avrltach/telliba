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
    @auth
        <h1 class="text-2xl font-semibold mb-2">Selamat datang, {{ Auth::user()->name }}! Kamu telah berhasil login ke Telliba.</h1>

        @if (session('status'))
            <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif
        
        <p class="text-gray-700 mb-4">Kelola dan akses arsip dokumen digital di Telliba dengan mudah.</p>

        @if (Auth::user()->role === 'admin')
            <a href="{{ route('admin.index') }}" class="inline-block bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700 transition duration-300">
                Kelola Dokumen
            </a>
        @endif
    @else
        <div class="text-center flex flex-col items-center justify-center">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Selamat datang di Telliba!</h1>
            <img src="{{ asset('images/logo.png') }}" alt="Gambar Selamat Datang" class="w-64 h-auto mb-4">
            <p class="text-gray-700 text-lg">Silakan login untuk mengakses arsip dokumen digital.</p>
        </div>
    @endauth
</div>

@auth
<div class="bg-white p-6 rounded shadow">
    <h2 class="text-xl font-bold mb-4">Dokumen Terbaru</h2>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse ($dokumens as $dokumen)
            <div class="block bg-white p-4 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition duration-200">
                <h2 class="text-lg text-justify font-semibold text-gray-900 mb-2">{{ $dokumen->title }}</h2>
                <p class="text-sm text-gray-700 text-justify mb-3">{{ Str::limit($dokumen->description, 100) }}</p>
                <a href="{{ route('dokumens.show', $dokumen->id) }}" class="hover:underline text-blue-600 font-medium">Lihat Dokumen</a>
            </div>
        @empty
            <div class="col-span-4 text-center text-gray-600 font-medium">
                Tidak Ada Dokumen yang Tersedia.
            </div>
        @endforelse
    </div>
</div>
@endauth
@endsection
