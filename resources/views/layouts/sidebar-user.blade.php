<!-- Custom Styled Sidebar (Visual Distinct Design) -->
<button id="customSidebarToggle" type="button" class="fixed top-5 left-5 z-50 inline-flex items-center p-3 bg-indigo-600 text-white rounded-full shadow-md hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-indigo-300 sm:hidden" aria-label="Toggle Sidebar">
    <svg class="w-6 h-6" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24">
        <path d="M4 6h16M4 12h16M4 18h16"></path>
    </svg>
</button>

<aside id="customSidebar" class="fixed top-0 left-0 z-40 w-72 h-full bg-gradient-to-tr from-indigo-900 via-indigo-800 to-indigo-700 text-indigo-50 shadow-lg transform -translate-x-full transition-transform duration-300 ease-in-out sm:translate-x-0 sm:relative sm:shadow-none" aria-label="Custom Sidebar">
    <div class="flex flex-col h-full p-6 overflow-y-auto">

        <!-- Brand -->
        <div class="mb-10 flex items-center space-x-3 select-none">
            <div class="bg-indigo-500 rounded-lg p-3 shadow-xl flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-100" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 7l1.5 12h15L21 7M16 3h-8l1 4h6l1-4z" />
                </svg>
            </div>
            <span class="text-2xl font-extrabold tracking-tight uppercase drop-shadow-lg select-text">Arsip Digital</span>
        </div>

     <!-- Profile Section (Versi Baru & Berbeda) -->
<div class="mb-8">
    <div class="relative bg-white/10 backdrop-blur-lg rounded-2xl p-5 shadow-lg border border-white/10 overflow-hidden">
        <!-- Ornamen Icon Bulat di Belakang Avatar -->
        <div class="absolute -top-4 -left-4 w-20 h-20 bg-indigo-500/20 rounded-full"></div>

        <div class="relative z-10 flex items-center space-x-4 mb-3">
            <div class="relative">
                <div class="bg-indigo-500 p-1 rounded-full shadow-md">
                    <img 
                        src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3B82F6&color=fff&size=64" 
                        alt="Profile"
                        class="w-14 h-14 rounded-full object-cover ring-2 ring-white"
                    />
                </div>
                <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white shadow-sm"></div>
            </div>
            <div class="flex-1 min-w-0">
                <h3 class="text-lg font-bold text-white truncate">{{ Auth::user()->name }}</h3>
                <p class="text-xs text-indigo-100 truncate">{{ Auth::user()->email }}</p>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-[10px] font-medium bg-indigo-200 text-indigo-900 mt-1">
                    <i class="fa-solid fa-user-shield mr-1"></i>
                    {{ Auth::user()->usertype }}
                </span>
            </div>
        </div>

        <div class="flex space-x-3">
            <a href="{{ route('profile.edit') }}" class="flex-1 flex items-center justify-center px-3 py-2 text-xs font-medium text-white bg-indigo-700 hover:bg-indigo-600 rounded-lg transition duration-300 group">
                <i class="fa-solid fa-sliders mr-1 group-hover:rotate-45 transition-transform duration-300"></i>
                Edit Profile
            </a>
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center px-3 py-2 text-xs font-medium text-red-600 bg-red-100 hover:bg-red-200 rounded-lg transition duration-300 group">
                    <i class="fa-solid fa-arrow-right-from-bracket mr-1 group-hover:translate-x-1 transition-transform duration-300"></i>
                    Logout
                </button>
            </form>
        </div>
    </div>
</div>


        <!-- Navigation -->
        <nav class="flex flex-col flex-grow space-y-3">
            <a href="#" class="group flex items-center space-x-4 px-4 py-3 rounded-2xl font-medium text-indigo-200 hover:text-white hover:bg-indigo-600 transition-all shadow-md">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12h18M3 6h18M3 18h18"/>
                </svg>
                <span>Dashboard</span>
            </a>

            <!-- Dokumen Dropdown -->
            <div>
                <button type="button" onclick="toggleDropdown('dokumenMenu')" class="w-full flex items-center justify-between px-4 py-3 rounded-2xl font-medium text-indigo-200 hover:text-white hover:bg-indigo-600 transition-all shadow-md">
                    <div class="flex items-center space-x-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-300 group-hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 7h16M4 12h16M4 17h16"/>
                        </svg>
                        <span>Dokumen</span>
                    </div>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="dokumenMenu" class="hidden flex flex-col space-y-1 mt-1 ml-6">
                    <a href="#" class="px-4 py-2 rounded-xl text-indigo-200 hover:bg-indigo-600 hover:text-white">Tambah Dokumen</a>
                    <a href="#" class="px-4 py-2 rounded-xl text-indigo-200 hover:bg-indigo-600 hover:text-white">Lihat Dokumen</a>
                </div>
            </div>

          

        </nav>

        <!-- Footer -->
        <footer class="mt-auto pt-6 text-center text-indigo-400 text-xs select-none">
            <p>Tugas Besar - PAW 2025</p>
        </footer>
    </div>
</aside>

<script>
    document.getElementById('customSidebarToggle').addEventListener('click', function() {
        const sidebar = document.getElementById('customSidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    function toggleDropdown(id) {
        const menu = document.getElementById(id);
        menu.classList.toggle('hidden');
    }
</script>

<style>
    #customSidebar::-webkit-scrollbar {
        width: 6px;
    }
    #customSidebar::-webkit-scrollbar-thumb {
        background-color: rgba(255 255 255 / 0.15);
        border-radius: 3px;
    }
    #customSidebar::-webkit-scrollbar-track {
        background: transparent;
    }
</style>
