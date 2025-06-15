<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Dokumen Baru') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokumens.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf

                <div class="col-span-1 md:col-span-2">
                    <label for="title" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Judul Dokumen</label>
                    <input type="text" name="title" id="title"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Masukkan judul dokumen"
                        value="{{ old('title') }}" required>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        placeholder="Masukkan deskripsi (opsional)">{{ old('description') }}</textarea>
                </div>

                <div>
                     <label for="category_id" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Kategori</label>
                        <select name="category_id" id="category_id" required
                             class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                         <option value="" disabled selected>Pilih kategori</option>
                         @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                        </option>
                        @endforeach
                        </select>
                </div>
                
                <div>
                    <label for="file" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Upload File</label>
                    <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.txt" required
                        class="block w-full text-sm text-gray-900 dark:text-gray-100 bg-gray-50 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg cursor-pointer focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Format file: pdf, doc, docx, xls, xlsx, txt</p>
                </div>

                <div class="col-span-1 md:col-span-2 text-right">
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800 shadow-sm transition">
                        Tambah Dokumen
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
