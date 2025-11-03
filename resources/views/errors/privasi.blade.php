<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Akses Ditolak | SPP Online</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            background: radial-gradient(circle at 20% 20%, rgba(37, 99, 235, 0.2), transparent 60%),
                radial-gradient(circle at 80% 80%, rgba(59, 130, 246, 0.15), transparent 60%),
                linear-gradient(to bottom right, #0f172a, #1e293b);
            backdrop-filter: blur(20px);
            min-height: 100vh;
            color: white;
            font-family: 'Inter', sans-serif;
        }

        .glow {
            box-shadow: 0 0 20px rgba(37, 99, 235, 0.4),
                0 0 40px rgba(59, 130, 246, 0.3);
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 min-h-screen text-white font-sans">



    <!-- 🔹 Konten Akses Ditolak -->
    <main class="flex flex-col items-center justify-center text-center min-h-screen pt-20 px-6">
        <div data-aos="zoom-in" class="bg-gray-800/70 backdrop-blur-lg rounded-2xl shadow-lg p-10 max-w-lg">
            <h2
                class="text-4xl font-extrabold bg-gradient-to-r from-red-500 to-orange-400 bg-clip-text text-transparent mb-4">
                🚫 Akses Ditolak
            </h2>
            <p class="text-gray-300 text-lg mb-6">
                Kamu tidak berhak meliat Data ini!
            </p>


        </div>
    </main>



    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>
