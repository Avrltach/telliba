<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet" />

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- Flowbite --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', 'Figtree', sans-serif;
        }
    </style>
</head>

<body class="font-sans antialiased bg-white">
    <div class="flex h-screen overflow-hidden">

        {{-- Sidebar --}}
        <div class="w-80 flex-shrink-0 hidden sm:block">
            @if(auth()->user()->usertype == 'admin')
                @include('layouts.sidebar-admin')
            @else
                @include('layouts.sidebar-user')
            @endif
        </div>

        {{-- Main content tanpa gap --}}
        <div class="flex flex-col flex-1 min-w-0 overflow-hidden">

            @isset($header)
            <header class="bg-white border-b border-gray-200 shadow-sm px-30 py-3 flex-shrink-0">
                <div class="w-fu">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <main class="flex-1 overflow-y-auto p-4">
                {{ $slot }}
            </main>
        </div>
    </div>

    {{-- Mobile overlay --}}
    @unless(Route::is('documents.show'))
    <div id="sidebar-overlay" class="fixed inset-0 bg-black bg-opacity-50 z-30 hidden sm:hidden"
        onclick="toggleSidebar()"></div>
    @endunless

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('default-sidebar');
            const overlay = document.getElementById('sidebar-overlay');

            if (sidebar && overlay) {
                sidebar.classList.toggle('-translate-x-full');
                overlay.classList.toggle('hidden');
            }
        }

        document.addEventListener('DOMContentLoaded', function () {
            const toggleButton = document.querySelector('[data-drawer-toggle="default-sidebar"]');
            if (toggleButton) {
                toggleButton.addEventListener('click', toggleSidebar);
            }
        });

        document.addEventListener('click', function (event) {
            const sidebar = document.getElementById('default-sidebar');
            const toggleButton = document.querySelector('[data-drawer-toggle="default-sidebar"]');
            const overlay = document.getElementById('sidebar-overlay');

            if (
                sidebar && !sidebar.contains(event.target) &&
                toggleButton && !toggleButton.contains(event.target) &&
                window.innerWidth < 640
            ) {
                sidebar.classList.add('-translate-x-full');
                if (overlay) overlay.classList.add('hidden');
            }
        });
    </script>
</body>
</html>