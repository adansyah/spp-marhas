<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin SPP | @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite('resources/css/app.css')

    <style>
        /* Animasi sidebar */
        .sidebar-transition {
            transition: transform 0.3s ease-in-out;
        }

        .sidebar-hidden {
            transform: translateX(-100%);
        }

        @media (min-width: 768px) {
            .sidebar-hidden {
                transform: translateX(0);
            }
        }
    </style>
</head>

<body
    class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 text-white font-poppins flex min-h-screen overflow-x-hidden">

    <!-- Sidebar -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 w-64 bg-gray-900/70 backdrop-blur-md border-r border-gray-800 z-50 sidebar-transition sidebar-hidden flex flex-col shadow-2xl">
        <div class="flex items-center justify-between px-6 py-4 border-b border-gray-800">
            <h1 class="text-xl font-bold flex items-center gap-2 text-indigo-400">
                <!-- Heroicon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 14l6.16-3.422A12.083 12.083 0 0118 20.944M12 14l-6.16-3.422A12.083 12.083 0 006 20.944M12 14v8" />
                </svg>
                <span>Admin SPP</span>
            </h1>
            <button id="closeSidebar" class="md:hidden text-gray-400 hover:text-white transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <nav class="flex-1 p-4 space-y-2">
            <a href="/admin/dashboard"
                class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-indigo-600/70 transition
                {{ request()->is('admin/dashboard') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-600/70 text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3v18h18M9 9h6v6H9z" />
                </svg>
                Dashboard
            </a>

            <a href="/admin/data-siswa"
                class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-indigo-600/70 transition
                {{ request()->is('admin/data-siswa') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-600/70 text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                </svg>
                Data Siswa
            </a>

            <a href="/admin/data-spp"
                class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-indigo-600/70 transition
                {{ request()->is('admin/data-spp') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-600/70 text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 4c-3.866 0-7 1.343-7 3v3h14v-3c0-1.657-3.134-3-7-3z" />
                </svg>
                Data SPP
            </a>
            <a href="/admin/laporan"
                class="flex items-center gap-3 px-4 py-2 rounded-lg hover:bg-indigo-600/70 transition
                {{ request()->is('admin/laporan') ? 'bg-indigo-600 text-white' : 'hover:bg-indigo-600/70 text-gray-300' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 4c-3.866 0-7 1.343-7 3v3h14v-3c0-1.657-3.134-3-7-3z" />
                </svg>
                Laporan
            </a>
        </nav>

        <div class="p-4 border-t border-gray-800">
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button
                    class="cursor-pointer w-full flex items-center justify-center gap-2 bg-red-600 hover:bg-red-700 px-4 py-2 rounded-lg transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H7a2 2 0 01-2-2v-1m0-8V7a2 2 0 012-2h4a2 2 0 012 2v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </aside>

    <!-- Overlay untuk mobile -->
    <div id="overlay"
        class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden z-40 md:hidden transition-opacity duration-300"></div>

    <!-- Main content -->
    <div class="flex-1 flex flex-col min-h-screen md:ml-64">
        <!-- Header -->
        <header
            class="flex items-center justify-between px-6 py-4 bg-gray-800/80 backdrop-blur-lg shadow-md sticky top-0 z-30">
            <div class="flex items-center gap-4">
                <!-- Hamburger for mobile -->
                <button id="hamburger"
                    class="md:hidden text-white focus:outline-none p-2 rounded-lg hover:bg-gray-700/50 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                {{-- <h2 class="text-lg md:text-xl font-bold">Dashboard Admin</h2> --}}
            </div>
            <div class="flex items-center gap-4">
                <span class="hidden sm:block text-sm opacity-80">{{ auth()->user()->nama }}</span>
                <img src="https://api.dicebear.com/9.x/avataaars/svg?seed=Admin"
                    class="w-10 h-10 rounded-full border-2 border-indigo-400" alt="Admin Avatar">
            </div>
        </header>

        <main class="p-6 flex-1 overflow-x-hidden">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const hamburger = document.getElementById('hamburger');
        const closeSidebar = document.getElementById('closeSidebar');
        const overlay = document.getElementById('overlay');

        hamburger.addEventListener('click', () => {
            sidebar.classList.remove('sidebar-hidden');
            overlay.classList.remove('hidden');
        });

        closeSidebar.addEventListener('click', () => {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.add('hidden');
        });
    </script>
</body>

</html>
