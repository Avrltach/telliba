<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Kategori Baru') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 max-w-7xl mx-auto">
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('categories.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @csrf

                <div class="col-span-1 md:col-span-2">
                    <label for="name" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Nama Kategori <span class="text-red-600">*</span>
                    </label>
                    <input type="text" name="name" id="name" required
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none"
                        value="{{ old('name') }}">
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label for="description" class="block mb-2 text-sm font-semibold text-gray-700 dark:text-gray-300">
                        Deskripsi
                    </label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white text-sm p-3 focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('description') }}</textarea>
                </div>

                <div class="col-span-1 md:col-span-2 text-right space-x-4">
                    <a href="{{ route('categories.index') }}"
                       class="inline-block px-6 py-3 rounded-lg border border-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="inline-flex items-center px-6 py-3 rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-300 dark:focus:ring-indigo-800 shadow-sm transition">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
