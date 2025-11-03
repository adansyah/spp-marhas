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
            <h3 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text mb-6">
                📘 Data Siswa
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-gray-300">
                <p><strong>Nama:</strong> {{ Auth::user()->nama }} </p>
                <p><strong>NIS:</strong> {{ AUth::user()->nis }}</p>
                <p><strong>Kelas:</strong> {{ Auth::user()->kelas }}</p>
                <p><strong>Alamat:</strong> {{ Auth::user()->alamat }}</p>
            </div>
        </section>

        <!-- 🔹 Riwayat Pembayaran -->
        <section id="riwayat"
            class="max-w-5xl mx-auto mt-20 mb-24 bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-lg p-6 sm:p-8"
            data-aos="fade-up">
            <h3 class="text-2xl sm:text-3xl font-bold bg-gradient-to-r from-blue-400 to-purple-500 bg-clip-text mb-6">
                🧾 Riwayat Pembayaran
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
                    <option value="belum lunas">belum lunas</option>
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
                                        <span
                                            class="inline-block px-3 py-1 text-sm font-semibold text-green-100 bg-green-600/70 rounded-full">
                                            Lunas</span>
                                    @else
                                        <span
                                            class="inline-block px-3 py-1 text-sm font-semibold text-orange-100 bg-orange-500/70 rounded-full">
                                            Belum Lunas</span>
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
