<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>SMK Marhas | SPP Online</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .fade-enter {
            opacity: 0;
            transform: translateY(10px);
        }

        .fade-enter-active {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.4s ease;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 min-h-screen text-white font-poppins">
    <!-- Efek Cahaya Biru -->
    <div class="absolute w-96 h-96 bg-blue-500/30 blur-3xl rounded-full -top-20 -left-20 animate-pulse"></div>
    <div class="absolute w-80 h-80 bg-blue-400/20 blur-3xl rounded-full bottom-10 right-10 animate-pulse"></div>

    <section id="landing" class="flex flex-col items-center justify-center min-h-screen text-center px-6 relative">

        <!--  Logo Sekolah -->
        <div class="mb-6 animate-pulse">
            <img src="{{ asset('marhas.jpg') }}" alt="Logo Sekolah"
                class="w-32 h-32 md:w-40 md:h-40 object-contain mx-auto drop-shadow-lg">
        </div>

        <h1 class="text-5xl md:text-6xl font-extrabold mb-4">
            Bayar SPP Lebih Mudah
        </h1>
        <p class="text-lg opacity-80 mb-8">
            Kelola pembayaran SPP kamu tanpa ribet, cepat, dan transparan.
        </p>

        <div class="flex sm:flex-col md:flex-row gap-4">
            <a href="{{ route('login') }}"
                class="bg-white text-gray-900 px-6 py-3 rounded-full font-semibold hover:bg-gray-200 transition cursor-pointer">
                Login
            </a>
            <a href="{{ route('register') }}"
                class="bg-transparent border border-white px-6 py-3 rounded-full font-semibold hover:bg-white hover:text-gray-900 transition cursor-pointer">
                Daftar
            </a>
        </div>
    </section>


    <section id="login" class="hidden min-h-screen flex flex-col justify-center items-center px-6">
        <div class="bg-gray-800 text-white rounded-2xl shadow-2xl w-full max-w-md p-8 fade-enter">
            <h2 class="text-3xl font-bold text-center mb-6">Login</h2>
            <input type="text" placeholder="NIS / Username"
                class="w-full border border-gray-600 bg-gray-900 text-white rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-gray-400" />
            <input type="password" placeholder="Password"
                class="w-full border border-gray-600 bg-gray-900 text-white rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-gray-400" />
            <button class="bg-gray-700 hover:bg-gray-600 text-white w-full py-2 rounded-lg transition">
                Masuk
            </button>
            <p class="text-center mt-4 text-sm">
                Belum punya akun?
                <span class="text-gray-300 font-semibold cursor-pointer hover:underline">Daftar</span>
            </p>
        </div>
    </section>

    <section id="register" class="hidden min-h-screen flex flex-col justify-center items-center px-6">
        <div class="bg-gray-800 text-white rounded-2xl shadow-2xl w-full max-w-md p-8 fade-enter">
            <h2 class="text-3xl font-bold text-center mb-6">Daftar</h2>
            <input type="text" placeholder="Nama Lengkap"
                class="w-full border border-gray-600 bg-gray-900 text-white rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-gray-400" />
            <input type="text" placeholder="NIS"
                class="w-full border border-gray-600 bg-gray-900 text-white rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-gray-400" />
            <input type="password" placeholder="Password"
                class="w-full border border-gray-600 bg-gray-900 text-white rounded-lg px-4 py-2 mb-4 focus:ring-2 focus:ring-gray-400" />
            <button class="bg-gray-700 hover:bg-gray-600 text-white w-full py-2 rounded-lg transition">
                Daftar Sekarang
            </button>
            <p class="text-center mt-4 text-sm">
                Sudah punya akun?
                <span class="text-gray-300 font-semibold cursor-pointer hover:underline">Login</span>
            </p>
        </div>
    </section>


    <section id="dashboard" class="hidden min-h-screen flex flex-col items-center px-4 py-8 fade-enter">
        <h2 class="text-3xl font-bold mb-6">
            Halo, <span id="username">Siswa</span> 👋
        </h2>
        <div class="bg-gray-800 text-white rounded-2xl shadow-2xl p-6 w-full max-w-3xl">
            <h3 class="text-2xl font-semibold mb-4">Tagihan SPP Bulan Ini</h3>
            <table class="w-full border-collapse text-gray-200">
                <thead>
                    <tr class="bg-gray-700 text-gray-100">
                        <th class="p-3 text-left">Bulan</th>
                        <th class="p-3 text-left">Jumlah</th>
                        <th class="p-3 text-center">Status</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody id="paymentTable"></tbody>
            </table>
        </div>
        <button class="mt-6 bg-red-600 px-6 py-2 rounded-full hover:bg-red-700 transition">
            Logout
        </button>
    </section>
</body>

</html>
