<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>404 - Halaman Tidak Ditemukan | SPP Online</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

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
            box-shadow: 0 0 25px rgba(37, 99, 235, 0.4),
                0 0 50px rgba(59, 130, 246, 0.3);
        }
    </style>
</head>

<body class="flex flex-col justify-center items-center text-center min-h-screen px-6">

    <div data-aos="zoom-in" class="max-w-lg bg-gray-900/70 backdrop-blur-xl rounded-2xl p-10 shadow-2xl glow">
        <h1 class="text-7xl font-extrabold text-blue-500 mb-4">404</h1>
        <h2 class="text-2xl font-semibold text-gray-200 mb-4">Halaman Tidak Ditemukan</h2>
        <p class="text-gray-400 mb-8">
            Maaf, halaman yang Anda cari tidak tersedia atau telah dipindahkan.
        </p>


    </div>



    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>
</body>

</html>
