@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
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
                dokumen.getElementById('{{ $id }}').classList.add('hidden');
            }

            setTimeout(function() {
                var el = dokumen.getElementById('{{ $id }}');
                if (el) el.classList.add('hidden');
            }, 5000);
        </script>
    @endif

    <div class="bg-white p-8 rounded shadow-lg">
        <div class="flex justify-between items-center mb-4">
            <h1 class="text-3xl font-bold text-gray-800">{{ $dokumen->title }}</h1>
            <p class="text-sm text-gray-500">{{ $dokumen->created_at->timezone('Asia/Jakarta')->format('d M Y, H:i') }}</p>
        </div>

        <p class="mt-4 text-gray-700 whitespace-pre-line">{{ $dokumen->description }}</p>

@if($dokumen->file_path)
    <div class="mt-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-2">File Dokumen:</h2>
        <div class="bg-gray-100 p-4 rounded shadow">
            <a href="{{ route('dokumen.view', $dokumen->id) }}" target="_blank" class="text-blue-600 hover:underline">
                📄 Lihat / Unduh Dokumen
            </a>
        </div>

        @if(Str::endsWith($dokumen->file_path, '.pdf'))
            <div class="mt-6">
                <iframe src="{{ route('dokumen.view', $dokumen->id) }}" width="100%" height="600" class="rounded border"></iframe>
            </div>
        @endif
    </div>
@endif

    </div>
</div>
@endsection
