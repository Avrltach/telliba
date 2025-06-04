@extends('layout.app')

@section('content')
<div class="w-full font-semibold text-gray-800 text-3xl mb-6">Unggah Dokumen Baru</div>

<form method="POST" action="{{ route('dokumen.store') }}" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-lg">
    @csrf

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">Judul Dokumen</label>
        <input type="text" name="judul" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">Deskripsi Dokumen</label>
        <textarea name="deskripsi" rows="4" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required></textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">Unggah File Dokumen (PDF, DOCX, dll)</label>
        <input type="file" id="fileInput" name="file_dokumen" class="w-full border px-3 py-2 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" required>
        <p id="fileName" class="text-sm text-gray-600 mt-2 hidden"></p>
    </div>

    <div class="flex justify-start items-center mt-6 gap-4">
        <a href="{{ route('admin.index') }}" class="px-4 py-2 rounded-full bg-gray-400 text-white">Batal</a>
        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-full hover:bg-green-700 transition duration-300">
            Simpan
        </button>
    </div>
</form>

<script>
dokumen.getElementById("fileInput").addEventListener("change", function(event) {
    const fileName = event.target.files[0]?.name;
    const fileNameElement = dokumen.getElementById("fileName");

    if (fileName) {
        fileNameElement.textContent = "File dipilih: " + fileName;
        fileNameElement.classList.remove("hidden");
    } else {
        fileNameElement.textContent = "";
        fileNameElement.classList.add("hidden");
    }
});
</script>
@endsection
