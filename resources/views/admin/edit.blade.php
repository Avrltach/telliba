<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dokumen') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-xl mx-auto">
        <form action="{{ route('admin.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')
            <div>
                <label class="block">Judul</label>
                <input type="text" name="Title" value="{{ $dokumen->Title }}" class="w-full border px-3 py-2 rounded" required>
            </div>
            <div>
                <label class="block">Kategori</label>
                <select name="CategoryID" class="w-full border px-3 py-2 rounded" required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $category->id == $dokumen->CategoryID ? 'selected' : '' }}>{{ $category->Name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block">Deskripsi</label>
                <textarea name="Description" class="w-full border px-3 py-2 rounded">{{ $dokumen->Description }}</textarea>
            </div>
            <div>
                <label class="block">Ganti File (opsional)</label>
                <input type="file" name="file" class="w-full border px-3 py-2 rounded">
                <p class="text-sm text-gray-500 mt-1">File saat ini: <a href="{{ asset('storage/' . $dokumen->FilePath) }}" class="text-blue-500" target="_blank">Lihat File</a></p>
            </div>
             <div class="flex justify-start items-center mt-6 p-2 space-x-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-300 text-gray-800 px-6 py-2 rounded-full hover:bg-gray-400 transition duration-300">
                Kembali
            </a>
            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-full hover:bg-yellow-600 transition duration-300">
                Update
            </button>
        </div>
        </form>
    </div>
<script>
    function previewImage(event) {
        const message = document.getElementById('imageMessage');
        const preview = document.getElementById('preview');
        const file = event.target.files[0];

        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('hidden');
            message.innerHTML = 'Preview Gambar Baru:';
        } else {
            imagePreview.classList.add('hidden');
            preview.src = '';
            message.innerHTML = '';
        }
    }
</script>
</x-app-layout>
