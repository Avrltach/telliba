<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Dokumen') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-xl mx-auto">
        <form action="{{ route('dokumen.update', $dokumen->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-gray-700">Judul</label>
                <input type="text" name="Title" value="{{ old('Title', $dokumen->Title) }}" class="w-full border px-3 py-2 rounded" required>
            </div>

            <div>
                <label class="block text-gray-700">Kategori</label>
                <select name="CategoryID" class="w-full border px-3 py-2 rounded" required>
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $dokumen->CategoryID == $category->id ? 'selected' : '' }}>
                            {{ $category->Name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700">Deskripsi</label>
                <textarea name="Description" rows="5" class="w-full border px-3 py-2 rounded" required>{{ old('Description', $dokumen->Description) }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700">File Dokumen</label>
                <input type="file" name="file" id="imageInput" class="w-full border px-3 py-2 rounded">
                @if($dokumen->file)
                    <div class="mt-2">
                        <a href="{{ asset('storage/' . $dokumen->file) }}" target="_blank" class="text-blue-600 underline">Lihat Dokumen Saat Ini</a>
                    </div>
                @endif
            </div>

            <div class="flex justify-start items-center gap-4 mt-4">
                <a href="{{ route('dokumen.dashboard') }}" class="px-4 py-2 rounded-full bg-gray-400 text-white">Batal</a>
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition duration-300">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
function previewImage(event) {
    const preview = document.getElementById("imagePreview");
    const file = event.target.files[0];

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove("hidden");
        };
        reader.readAsDataURL(file);
    } else {
        preview.classList.add("hidden");
        preview.src = "";
    }
}

document.getElementById("imageInput").addEventListener("change", previewImage);
</script>
