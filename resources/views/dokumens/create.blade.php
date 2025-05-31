<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Dokumen') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-xl mx-auto">
        <form action="{{ route('dokumen.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block text-gray-700">Judul</label>
                <input type="text" name="Title" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">Kategori</label>
                <select name="CategoryID" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->Name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Deskripsi</label>
                <textarea name="Description" rows="5" class="w-full border px-3 py-2 rounded" required></textarea>
            </div>

            <div>
                <label class="block text-gray-700">File Dokumen</label>
                <input type="file" name="file" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div class="flex justify-start items-center gap-4">
                <a href="{{ route('dokumen.dashboard') }}" class="px-4 py-2 rounded-full bg-gray-400 text-white">Batal</a>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
