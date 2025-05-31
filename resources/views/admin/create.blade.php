<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Dokumen') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-xl mx-auto">
        <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            <div>
                <label class="block">Judul</label>
                <input type="text" name="Title" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block">Kategori</label>
                <select name="CategoryID" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Deskripsi</label>
                <textarea name="Description" class="w-full border px-3 py-2 rounded"></textarea>
            </div>
            <div>
                <label class="block">File Dokumen</label>
                <input type="file" name="file" class="w-full border px-3 py-2 rounded" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
        </form>
    </div>
</x-app-layout>
