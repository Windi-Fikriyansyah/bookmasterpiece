<div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-4 flex items-center justify-between shadow-sm">
    <button id="menuBtn" onclick="toggleSidebar()" class="hover:bg-white/20 p-2 rounded transition-colors lg:hidden">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>

    <div class="flex-1 flex items-center gap-2 ml-4">
        <span class="text-sm opacity-90 hidden md:inline">Dashboard Tutorial > </span>
        <span class="font-medium">{{ $pageTitle ?? 'Dashboard' }}</span>
    </div>

    <div class="flex items-center gap-3">

        <!-- Notifikasi -->
        <button class="hover:bg-white/20 p-2 rounded transition-colors relative">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </svg>
            <span
                class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">3</span>
        </button>

        <!-- Icon User -->
        <div class="relative">
            <button onclick="toggleLogoutMenu()" class="hover:bg-white/20 p-2 rounded transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </button>

            <!-- Dropdown Logout -->
            <div id="logoutMenu"
                class="hidden absolute right-0 mt-2 bg-white text-gray-800 rounded shadow-lg w-40 py-2 z-50">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100 flex items-center gap-2">
                        <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1m0-1a3 3 0 100-6 3 3 0 000 6z" />
                        </svg>
                        Logout
                    </button>
                </form>

            </div>
        </div>

    </div>
</div>

<script>
    function toggleLogoutMenu() {
        document.getElementById("logoutMenu").classList.toggle("hidden");
    }

    document.addEventListener("click", function(e) {
        const menu = document.getElementById("logoutMenu");
        if (!e.target.closest("#logoutMenu") && !e.target.closest("[onclick='toggleLogoutMenu()']")) {
            menu.classList.add("hidden");
        }
    });
</script>
