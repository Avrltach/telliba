<!-- Tombol Toggle Sidebar (Mobile) -->
<button id="toggleSidebar" type="button"
    class="inline-flex items-center p-2 mt-2 ml-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
    <span class="sr-only">Open sidebar</span>
    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
        <path clip-rule="evenodd" fill-rule="evenodd"
            d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z" />
    </svg>
</button>

<!-- Sidebar -->
<aside id="default-sidebar"
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0 bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 py-5 overflow-y-auto">
        <ul class="space-y-2">
            <!-- Overview -->
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                        <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                    </svg>
                    <span class="ml-3">Overview</span>
                </a>
            </li>

            <!-- Dropdown: Jurnalku -->
            <li>
                <button type="button" data-dropdown-toggle="dropdown-jurnalku"
                    class="flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left">Jurnalku</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-jurnalku" class="hidden py-2 space-y-2">
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Settings</a></li>
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Kanban</a></li>
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Calendar</a></li>
                </ul>
            </li>

            <!-- Dropdown: Authentication -->
            <li>
                <button type="button" data-dropdown-toggle="dropdown-auth"
                    class="flex items-center w-full p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="flex-1 ml-3 text-left">Authentication</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>
                <ul id="dropdown-auth" class="hidden py-2 space-y-2">
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Sign In</a></li>
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Sign Up</a></li>
                    <li><a href="#" class="block pl-11 pr-2 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">Forgot Password</a></li>
                </ul>
            </li>
        </ul>

        <!-- Footer Link -->
        <ul class="pt-5 mt-5 space-y-2 border-t border-gray-200 dark:border-gray-700">
            <li>
                <a href="#"
                    class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    <svg class="w-6 h-6 text-gray-400 dark:text-gray-400"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                        <path fill-rule="evenodd"
                            d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-3">Docs</span>
                </a>
            </li>
        </ul>
    </div>
</aside>

<!-- Script Toggle Sidebar & Dropdown -->
<script>
    // Sidebar toggle
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        const sidebar = document.getElementById('default-sidebar');
        sidebar.classList.toggle('-translate-x-full');
    });

    // Dropdown toggle
    document.querySelectorAll('[data-dropdown-toggle]').forEach(button => {
        const targetId = button.getAttribute('data-dropdown-toggle');
        const dropdown = document.getElementById(targetId);

        button.addEventListener('click', () => {
            dropdown.classList.toggle('hidden');
        });
    });
</script>
