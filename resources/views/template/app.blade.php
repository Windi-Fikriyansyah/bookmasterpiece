<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ebook Master Maker')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @stack('styles')
    <style>
        .sidebar-active {
            background-color: #dbeafe;
            /* bg-blue-100 */
            border-left: 4px solid #2563eb;
            /* border-blue-600 */
        }
    </style>

</head>

<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        @include('template.sidebar')

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            @include('template.topbar')

            <!-- Content Area -->
            <div class="flex-1 overflow-y-auto p-6 md:p-8">
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        // Track sidebar state
        let isSidebarOpen = true;

        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.getElementById('menuBtn');

            if (isSidebarOpen) {
                // Close sidebar
                sidebar.classList.remove('w-80');
                sidebar.classList.add('w-0', 'hidden');
                isSidebarOpen = false;

                // Show menu button in mobile view
                if (window.innerWidth >= 1024) {
                    menuBtn.classList.remove('lg:hidden');
                }
            } else {
                // Open sidebar
                sidebar.classList.remove('w-0', 'hidden');
                sidebar.classList.add('w-80');
                isSidebarOpen = true;

                // Hide menu button on desktop when sidebar is open
                if (window.innerWidth >= 1024) {
                    menuBtn.classList.add('lg:hidden');
                }
            }
        }

        function toggleSection(section) {
            const content = document.getElementById(section + '-content');
            const icon = document.getElementById(section + '-icon');

            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        }

        // Handle responsive behavior
        function handleResize() {
            const sidebar = document.getElementById('sidebar');
            const menuBtn = document.getElementById('menuBtn');

            if (window.innerWidth < 1024) {
                // Mobile view - sidebar hidden by default, show menu button
                sidebar.classList.add('hidden');
                sidebar.classList.remove('w-80');
                sidebar.classList.add('w-0');
                menuBtn.classList.remove('hidden');
                isSidebarOpen = false;
            } else {
                // Desktop view - sidebar visible by default
                sidebar.classList.remove('hidden', 'w-0');
                sidebar.classList.add('w-80');
                menuBtn.classList.add('lg:hidden');
                isSidebarOpen = true;
            }
        }

        // Initialize on load
        document.addEventListener('DOMContentLoaded', function() {
            // Open the first section by default
            const aksesContent = document.getElementById('akses-content');
            const aksesIcon = document.getElementById('akses-icon');

            if (aksesContent && aksesIcon) {
                aksesContent.classList.remove('hidden');
                aksesIcon.classList.add('rotate-180');
            }

            // Handle initial responsive state
            handleResize();

            // Listen for window resize
            window.addEventListener('resize', handleResize);
        });
    </script>

    @stack('scripts')
</body>

</html>
