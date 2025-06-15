@php
    use Carbon\Carbon;
@endphp

<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="bg-blue-600 text-white rounded-xl p-5 relative shadow-lg">
                    <div class="text-3xl font-bold">{{ $totalDokumen }}</div>
                    <div class="text-sm mb-4">Total Dokumen</div>
                    <div class="flex items-center text-sm text-indigo-200">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8 7V3m8 4V3M3 11h18M5 19h14" />
                        </svg>
                        Pada {{ Carbon::now()->translatedFormat('d F Y') }}
                    </div>
                    <div class="absolute top-4 right-4 opacity-30">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 12h6m2 4H7m10-8H7" />
                        </svg>
                    </div>
                </div>
                <div class="bg-orange-500 text-white rounded-xl p-5 relative shadow-lg">
                    <div class="text-3xl font-bold">{{ $totalKategori }}</div>
                    <div class="text-sm mb-4">Total Kategori</div>
                    <div class="flex items-center text-sm text-orange-100">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12A9 9 0 113 12a9 9 0 0118 0z" />
                        </svg>
                        Kategori digunakan
                    </div>
                    <div class="absolute top-4 right-4 opacity-30">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                </div>
                
                <div class="bg-blue-500 text-white rounded-xl p-5 relative shadow-lg">
                    <div class="text-3xl font-bold">{{ $totalUser }}</div>
                    <div class="text-sm mb-4">Total User</div>
                    <div class="flex items-center text-sm text-blue-100">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.79.674 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0zM19 21v-2a4 4 0 00-8 0v2" />
                        </svg>
                        User aktif
                    </div>
                    <div class="absolute top-4 right-4 opacity-30">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                        </svg>
                    </div>
                </div>

                <a href="{{ route('dokumens.create') }}"
                    class="bg-white border rounded-xl shadow-lg flex items-center justify-between p-5 hover:bg-gray-50 transition">
                    <div>
                        <h3 class="font-semibold text-lg text-gray-800">Tambah Arsip</h3>
                        <p class="text-sm text-gray-500">Tambah arsip dokumen digital</p>
                    </div>
                    <div class="bg-red-600 text-white rounded-lg p-3">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="py-10">
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 max-w-7xl mx-auto">

                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg shadow-sm">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Judul Dokumen -->
                    <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Dokumen</h2>

                    <!-- Tabel Dokumen -->
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
                                            @if (auth()->user()->usertype == 'admin')
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

        </div>
    </div>
</x-app-layout>