<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPP Paymnet App | Dashboard</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />

    {{-- Aktifkan Tailwind v4 dan JS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- AOS Animation --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="css/dashboard.css">



</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 min-h-screen text-white font-sans">

    <!-- 🔹 Navbar -->
    <nav class="fixed top-0 w-full bg-gray-900/80 backdrop-blur-md border-b border-gray-700 shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 py-3 flex justify-between items-center">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-white to-white bg-clip-text text-transparent">
                SPP MARHAS
            </h1>

            <!-- Tombol menu untuk mobile -->
            <button id="menu-toggle" class="sm:hidden text-white text-2xl">☰</button>

            <!-- Tombol logout untuk desktop -->
            <form action="{{ route('logout') }}" method="POST" class="hidden sm:flex items-center">
                @csrf
                <button type="submit"
                    class="cursor-pointer flex items-center gap-2 bg-white text-black px-4 py-2 rounded-full font-semibold hover:scale-105 transition">
                    Logout
                </button>
            </form>
        </div>

        <!-- Menu mobile -->
        <div id="mobile-menu" class="hidden sm:hidden bg-trasnparent px-4 py-2 pb-3">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full text-left bg-gradient-to-r from-purple-600 to-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:scale-105 transition glow">
                    🚀 Logout
                </button>
            </form>
        </div>
    </nav>

    <script>
        document.getElementById('menu-toggle').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>


    <main class="px-4 sm:px-8">
        <!-- 🔹 Hero -->
        <section id="home" class="pt-32 text-center">
            <h2
                class="text-4xl sm:text-5xl font-extrabold bg-gradient-to-r from-grey-100 to-white bg-clip-text text-transparent mb-4 ">
                SPP Online Siswa
            </h2>
            <p class="text-gray-300 text-base sm:text-lg mb-8">
                Akses data dan lakukan pembayaran SPP dengan mudah, cepat, dan aman.
            </p>

        </section>

        <!-- 🔹 Data Siswa -->
        <section id="data-siswa"
            class="max-w-5xl mx-auto mt-24 bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-lg p-6 sm:p-8"
            data-aos="fade-up">

            <h3
                class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text mb-6 text-center">
                Profil Siswa
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-300">
                <!-- Nama -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A6 6 0 1112 18a6 6 0 01-6.879-.196zM12 14a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                    <p><strong>Nama:</strong> {{ Auth::user()->nama }}</p>
                </div>

                <!-- NIS -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3M3 11h18M5 19h14v-2H5v2z" />
                    </svg>
                    <p><strong>NIS:</strong> {{ Auth::user()->nis }}</p>
                </div>

                <!-- Kelas -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 14l9-5-9-5-9 5 9 5zM12 14v7M12 14L3 9m9 5l9-5" />
                    </svg>
                    <p><strong>Kelas:</strong> {{ Auth::user()->kelas }}</p>
                </div>

                <!-- Alamat -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <p><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
                </div>

                <!-- Email -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M16 12h.01M8 12h.01M12 16v-4M21 12c0 4.418-4.03 8-9 8s-9-3.582-9-8 4.03-8 9-8 9 3.582 9 8z" />
                    </svg>
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                </div>

                <!-- No. Telp -->
                <div
                    class="flex items-center gap-3 bg-gray-700/50 p-4 rounded-lg shadow-sm hover:bg-gray-700 transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H5a2 2 0 01-2-2V5zM15 3h6v6h-6V3zM15 15h6v6h-6v-6zM3 15h6v6H3v-6z" />
                    </svg>
                    <p><strong>No. Telp:</strong> {{ Auth::user()->no_telp }}</p>
                </div>
            </div>
        </section>


        <!-- 🔹 Riwayat Pembayaran -->
        <section id="riwayat"
            class="max-w-5xl mx-auto mt-20 mb-24 bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-lg p-6 sm:p-8"
            data-aos="fade-up">
            <h3
                class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text mb-6 text-center">
                Riwayat Tagihan SPP
            </h3>

            <!-- 🔹 Filter -->
            <div class="flex flex-col sm:flex-row gap-4 mb-6">
                <input id="searchBulan" type="text" placeholder="Cari Bulan..."
                    class="flex-1 bg-gray-900 border border-gray-700 text-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400" />

                <input id="searchTahun" type="text" placeholder="Cari Tahun (misal: 2025)"
                    class="flex-1 bg-gray-900 border border-gray-700 text-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400" />

                <select id="searchStatus"
                    class="flex-1 bg-gray-900 border border-gray-700 text-gray-200 rounded-lg p-2 focus:ring-2 focus:ring-blue-400">
                    <option value="">Semua Status</option>
                    <option value="lunas">Lunas</option>
                    <option value="Menunggu">Menunggu</option>
                </select>
            </div>

            <!-- 🔹 Tabel -->
            <div class="overflow-x-auto rounded-xl border border-gray-700 shadow-inner">
                <table id="tabelRiwayat"
                    class="min-w-full text-gray-200 text-center border-collapse rounded-xl overflow-hidden">
                    <thead class="bg-gray-900 text-gray-300">
                        <tr>
                            <th class="px-4 py-3">Bulan</th>
                            <th class="px-4 py-3">Tahun</th>
                            <th class="px-4 py-3">Jumlah</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Tanggal</th>
                            <th class="px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($spp as $item)
                            <tr class="hover:bg-gray-700/40 transition duration-200 ease-in-out">
                                <td class="px-4 py-3">{{ $item->bulan }}</td>
                                <td class="px-4 py-3">{{ $item->tahun }}</td>
                                <td class="px-4 py-3">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                                <td class="px-4 py-3">
                                    @if ($item->status === 'lunas')
                                        <span class="text-emerald-400">Lunas</span>
                                    @else
                                        <span class="text-rose-400">Menunggu</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">{{ $item->created_at->translatedFormat('d M Y') }}</td>
                                <td class="px-4 py-3">
                                    @if ($item->status !== 'lunas')
                                        @csrf
                                        <input type="hidden" name="bulan" value="{{ $item->bulan }}">
                                        <input type="hidden" name="nominal" value="{{ $item->nominal }}">
                                        <a href="{{ route('detail', $item->id) }}"
                                            class="bg-red-500 hover:bg-red-600 text-white font-semibold px-3 py-1 rounded-lg text-xs cursor-pointer">
                                            Bayar
                                        </a>
                                    @elseif($item->status === 'lunas')
                                        <a href="{{ route('cetak', $item->id) }}" target="_blank"
                                            class="inline-flex items-center justify-center gap-1 bg-amber-500 hover:bg-amber-600 text-white text-xs font-semibold px-3 py-1 rounded-lg transition">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" class="h-4 w-4" stroke-width="1.5"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                            </svg>
                                            <span>Cetak</span>
                                        </a>
                                    @endif
                                </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-gray-400 py-6">Belum ada data SPP</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>

    </main>

    <!-- 🔹 Footer -->
    <footer class="bg-gray-900/80 backdrop-blur-md border-t border-gray-700 text-center py-6 text-sm text-gray-400">
        © 2025 <span class="font-semibold text-blue-400">SPP MARHAS</span> | Design By Syahdan Mutahariq
    </footer>


    <script>
        const bulanInput = document.getElementById("searchBulan");
        const tahunInput = document.getElementById("searchTahun");
        const statusSelect = document.getElementById("searchStatus");
        const tabel = document.querySelector("#tabelRiwayat tbody");

        function filterTabel() {
            const bulanVal = bulanInput.value.toLowerCase();
            const tahunVal = tahunInput.value.trim();
            const statusVal = statusSelect.value.toLowerCase();

            Array.from(tabel.rows).forEach((row) => {
                const bulan = row.cells[0].textContent.toLowerCase();
                const tahun = row.cells[1].textContent.trim();
                const status = row.cells[3].textContent.toLowerCase();

                const cocokBulan = bulan.includes(bulanVal);
                const cocokTahun = tahun.includes(tahunVal);
                const cocokStatus = statusVal === "" || status.includes(statusVal);

                row.style.display = cocokBulan && cocokTahun && cocokStatus ? "" : "none";
            });
        }

        bulanInput.addEventListener("input", filterTabel);
        tahunInput.addEventListener("input", filterTabel);
        statusSelect.addEventListener("change", filterTabel);

        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
    @if (session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top',
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: '#333',
                color: '#fff',
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top',
                icon: 'error',
                title: "{{ session('error') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                background: '#ff4d4d',
                color: '#fff',
            });
        </script>
    @endif



</body>


</html>
