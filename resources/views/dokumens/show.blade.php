<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Bagian kiri: Info dokumen --}}
            <div class="col-span-1">
                <h1 class="text-2xl font-bold mb-6 text-gray-900 dark:text-white">{{ $dokumen->title }}</h1>

                <p class="mb-4 text-gray-900 dark:text-gray-300">
                    <strong>Kategori:</strong> 
                    {{ $dokumen->category ? $dokumen->category->name : '-' }}
                </p>

                <p class="mb-6 whitespace-pre-line text-gray-700 dark:text-gray-300">
                    {{ $dokumen->description ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="mt-6">
                    <a href="{{ route('dokumens.index') }}" class="inline-flex items-center px-4 py-2 rounded-lg border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                        &larr; Kembali ke daftar dokumen
                    </a>
                </div>
            </div>

            {{-- Bagian kanan: Preview file & download --}}
            <div class="col-span-1 flex flex-col items-center justify-start">
                @if($dokumen->file_path)
                    @php
                        $extension = pathinfo($dokumen->file_path, PATHINFO_EXTENSION);
                        $fileUrl = asset('storage/' . $dokumen->file_path);
                    @endphp

                    @if(in_array(strtolower($extension), ['pdf']))
                        <iframe src="{{ $fileUrl }}" class="w-full h-96 border rounded-lg mb-6" frameborder="0"></iframe>
                    @elseif(in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']))
                        <img src="{{ $fileUrl }}" alt="{{ $dokumen->title }}" class="w-full max-h-96 object-contain rounded-lg shadow mb-6" />
                    @endif

                    <a href="{{ $fileUrl }}" target="_blank"
                       class="inline-flex items-center px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 shadow-sm transition">
                        Download File
                    </a>
                @else
                    <p class="text-red-500">File tidak tersedia.</p>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
