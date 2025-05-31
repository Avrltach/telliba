<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
          {{ __('Dashboard admin kiee') }}
      </h2>
  </x-slot>
    <div class="p-4 max-w-7xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Dokumen</a>

        <table class="min-w-full bg-white border">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Judul</th>
                    <th class="border px-4 py-2">Kategori</th>
                    <th class="border px-4 py-2">Deskripsi</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dokumens as $dokumen)
                    <tr>
                        <td class="border px-4 py-2">{{ $dokumen->Title }}</td>
                        <td class="border px-4 py-2">{{ $dokumen->category->Name ?? '-' }}</td>
                        <td class="border px-4 py-2">{{ $dokumen->Description }}</td>
                        <td class="border px-4 py-2 flex gap-2">
                            <a href="{{ asset('storage/' . $dokumen->FilePath) }}" class="text-blue-500" target="_blank">Lihat</a>
                            <a href="{{ route('admin.edit', $dokumen->id) }}" class="text-yellow-500">Edit</a>
                            <form action="{{ route('admin.destroy', $dokumen->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>