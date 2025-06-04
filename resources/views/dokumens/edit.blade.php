<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dokumen') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-xl mx-auto">
        <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5 bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700 font-medium mb-1">Judul Dokumen</label>
                <input type="text" name="Title" value="{{ old('Title', $dokumen->Title) }}" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Kategori</label>
                <select name="CategoryID" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $dokumen->CategoryID == $category->id ? 'selected' : '' }}>
                            {{ $category->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Deskripsi</label>
                <textarea name="Description" rows="5" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500" required>{{ old('Description', $dokumen->Description) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-medium mb-1">Unggah File Baru (opsional)</label>
                <input type="file" name="file" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-500">

                @if($dokumen->file)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank" class="text-blue-600 underline">
                            📄 Lihat File Dokumen Saat Ini
                        </a>
                    </div>
                @endif
            </div>

            <div class="flex justify-start items-center gap-4 mt-6">
                <a href="{{ route('dokumen.dashboard') }}" class="px-4 py-2 rounded-full bg-gray-400 text-white hover:bg-gray-500 transition">Batal</a>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-full hover:bg-yellow-600 transition">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
