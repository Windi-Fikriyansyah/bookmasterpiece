<div id="sidebar" class="w-80 bg-white border-r border-gray-200 flex flex-col transition-all duration-300 ease-in-out">
    <!-- Header -->
    <div class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white p-4 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <button onclick="toggleSidebar()" class="hover:bg-white/20 p-1 rounded transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
            <div>
                <h1 class="text-lg font-bold">Ebook Master Maker</h1>
                <p class="text-xs opacity-90">Dashboard Tutorial</p>
            </div>
        </div>
    </div>

    <!-- Navigation -->
    <div class="flex-1 overflow-y-auto py-2">
        <!-- Start Section -->
        <div class="border-b border-gray-200">
            <div class="p-4 flex items-center justify-between bg-gradient-to-r from-blue-50 to-cyan-50">
                <div>
                    <div class="font-bold text-gray-800">MULAI DARI SINI DULU</div>
                    <div class="text-sm text-gray-600">Agreement dan Pengenalan</div>
                </div>
                <div class="bg-green-100 p-2 rounded-full">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Akses Aplikasi Section -->
        <div class="border-b border-gray-200">
            <button onclick="toggleSection('akses')"
                class="w-full p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="bg-blue-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="font-semibold text-gray-800">AKSES APLIKASI</span>
                        <p class="text-xs text-gray-500 mt-1">3 item • Selesai</p>
                    </div>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <svg id="akses-icon" class="w-5 h-5 text-gray-500 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                    </svg>
                </div>
            </button>

            <div id="akses-content" class="bg-blue-50/50">
                <!-- MENU 1 -->
                <a id="sidebar-tab1" href="{{ route('akses.aplikasi', ['tab' => 1]) }}"
                    class="sidebar-link w-full p-3 pl-12 flex items-center justify-between hover:bg-blue-100/50 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded-md">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-sm font-medium text-gray-800">1. Link Akses Aplikasi "Ebook Master
                                Maker"</span>
                            <p class="text-xs text-gray-600 mt-0.5">Akses utama aplikasi</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                <!-- MENU 2 -->
                <a id="sidebar-tab2" href="{{ route('akses.aplikasi', ['tab' => 2]) }}"
                    class="sidebar-link w-full p-3 pl-12 flex items-center justify-between hover:bg-blue-100/50 transition-all">
                    <div class="flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded-md">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-sm font-medium text-gray-800">2. Link Akses Aplikasi BONUS "Ebook Cover
                                Maker"</span>
                            <p class="text-xs text-gray-600 mt-0.5">Bonus pembuat cover ebook</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </a>

                <!-- MENU 3 -->
                <a id="sidebar-tab3" href="{{ route('akses.aplikasi', ['tab' => 3]) }}"
                    class="sidebar-link w-full p-3 pl-12 flex items-center justify-between hover:bg-blue-100/50 transition-all">

                    <div class="flex items-center gap-3">
                        <div class="bg-white p-1.5 rounded-md">
                            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="text-left">
                            <span class="text-sm font-medium text-gray-800">3. Link Akses Bonus Ebook "Ebook Banjir
                                Pembeli Tanpa Ngiklan"</span>
                            <p class="text-xs text-gray-600 mt-0.5">Strategi pemasaran ebook</p>
                        </div>
                    </div>
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
            </div>

        </div>

        <!-- Tutorial Section -->
        <div class="border-b border-gray-200">
            <button onclick="toggleSection('tutorial')"
                class="w-full p-4 flex items-center justify-between hover:bg-gray-50 transition-colors">
                <div class="flex items-center gap-3">
                    <div class="bg-purple-100 p-2 rounded-lg">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <div class="text-left">
                        <span class="font-semibold text-gray-800">TUTORIAL PENGGUNAAN</span>
                        <p class="text-xs text-gray-500 mt-1">8 item • Belum mulai</p>
                    </div>
                </div>
                <svg id="tutorial-icon" class="w-5 h-5 text-gray-500 transition-transform" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
            <div id="tutorial-content" class="hidden bg-gray-50">
                <!-- Tutorial content here -->
            </div>
        </div>


    </div>
</div>
