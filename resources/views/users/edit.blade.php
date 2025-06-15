<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-10">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-md p-10 max-w-7xl mx-auto">

            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-lg shadow-sm">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="name" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Nama</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 p-3" />
                </div>

                <div class="mb-6">
                    <label for="email" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 p-3" />
                </div>

                <div class="mb-6">
                    <label for="usertype" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">Usertype</label>
                    <select id="usertype" name="usertype" required
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 p-3">
                        <option value="admin" {{ old('usertype', $user->usertype) == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('usertype', $user->usertype) == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label for="password" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">
                        Password <small>(kosongkan jika tidak ingin ganti)</small>
                    </label>
                    <input type="password" id="password" name="password"
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 p-3" />
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="block mb-2 font-semibold text-gray-700 dark:text-gray-300">
                        Konfirmasi Password
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        class="w-full rounded border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-200 p-3" />
                </div>

                <div class="flex justify-end space-x-4">
                    <a href="{{ route('users.index') }}" class="px-6 py-3 bg-gray-300 rounded hover:bg-gray-400 text-gray-800">Batal</a>
                    <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white rounded">Simpan</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
