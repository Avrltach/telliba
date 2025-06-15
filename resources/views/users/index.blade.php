<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar User') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 max-w-7xl mx-auto">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-lg shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto rounded-lg">
                <table class="min-w-full text-sm text-left text-gray-700 dark:text-gray-300">
                    <thead class="bg-gray-100 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-4">Nama</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Usertype</th>
                            <th class="px-6 py-4">Password (hashed)</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr class="border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ $user->usertype }}</td>
                                <td class="px-6 py-4">{{ Str::limit($user->password, 10, '...') }}</td>
                                <td class="px-6 py-4 space-x-4">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-yellow-600 hover:underline">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus user ini?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-8 text-gray-500 dark:text-gray-400">Belum ada user.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-8">
                {{ $users->links() }}
            </div>

        </div>
    </div>
</x-app-layout>
