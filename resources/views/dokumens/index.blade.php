<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Dokumen') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 max-w-7xl mx-auto">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-8 text-right">
                <a href="{{ route('dokumens.create') }}"
                   class="inline-block px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg shadow-sm transition">
                    Tambah Dokumen Baru
                </a>
            </div>

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4">Judul</th>
                            <th class="px-6 py-4">Kategori</th>
                            <th class="px-6 py-4">Deskripsi</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dokumens as $doc)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $doc->title }}</td>
                                <td class="px-6 py-4">{{ $doc->category->name }}</td>
                                <td class="px-6 py-4">{{ Str::limit($doc->description, 80, '...') }}</td>
                                <td class="px-6 py-4 space-x-4">
                                    @if (auth()->user()->usertype =='admin')
                                    <a href="{{ route('dokumens.show', $doc->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    <a href="{{ route('dokumens.edit', $doc->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('dokumens.destroy', $doc->id) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Yakin ingin menghapus dokumen ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                    @else
                                    <a href="{{ route('dokumens.show', $doc->id) }}" class="text-blue-600 hover:underline">Lihat</a>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center py-8 text-gray-500 dark:text-gray-400">Belum ada dokumen.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $dokumens->links() }}
            </div>
        </div>
    </div>
</x-app-layout>