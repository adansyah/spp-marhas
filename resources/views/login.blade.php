<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPP Payment App | Login </title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body
    class="bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 min-h-screen text-white font-poppins flex flex-col items-center justify-center p-4 relative overflow-hidden">

    <!-- Efek Cahaya Biru -->
    <div class="absolute w-96 h-96 bg-blue-500/30 blur-3xl rounded-full -top-20 -left-20 animate-pulse"></div>
    <div class="absolute w-80 h-80 bg-blue-400/20 blur-3xl rounded-full bottom-10 right-10 animate-pulse"></div>

    <!-- Container -->
    <div
        class="w-full max-w-md bg-gray-800/90 backdrop-blur-md rounded-2xl shadow-2xl p-8 transition-all duration-500 z-10 border border-gray-700">
        <h1 id="formTitle" class="text-3xl font-bold text-center mb-6">Login</h1>

        <!-- LOGIN FORM -->
        <form action="{{ route('prosesLogin') }}" method="post" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-semibold mb-1">NIS</label>
                <div class="flex items-center bg-gray-900 rounded-lg border border-gray-700 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c0-1.657 1.343-3 3-3h6v10h-6a3 3 0 01-3-3V11zM3 8h6a3 3 0 013 3v2a3 3 0 01-3 3H3V8z" />
                    </svg>
                    <input type="text" id="loginnis" name="nis"
                        class="w-full py-2 bg-transparent focus:outline-none " placeholder="NIS" required />
                </div>
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1">Password</label>
                <div class="flex items-center bg-gray-900 rounded-lg border border-gray-700 px-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-400 mr-2" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 11c.667 0 1.333.333 2 1V9a4 4 0 00-8 0v3c.667-.667 1.333-1 2-1h4zM5 11h14v10H5V11z" />
                    </svg>
                    <input type="password" name="password" id="loginPassword"
                        class="w-full py-2 bg-transparent focus:outline-none " placeholder="Password" required />
                </div>
            </div>

            <button type="submit"
                class="cursor-pointer w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition shadow-lg shadow-blue-500/30">
                Masuk
            </button>
            <p class="text-center text-sm ">
                Belum punya akun?
                <a href="{{ route('register') }}"><span
                        class="font-semibold cursor-pointer hover:underline text-blue-400">Daftar
                        Sekarang</span></a>
            </p>
            <button type="button" id="googleLogin" onclick="window.location='{{ route('google.login') }}'"
                class="cursor-pointer w-full mt-2 md:ml-7 md:w-80 bg-white hover:bg-gray-200 text-black font-semibold py-2 rounded-lg transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="inline h-5 w-5 mr-1" viewBox="0 0 48 48">
                    <path fill="#EA4335"
                        d="M24 9.5c3.5 0 6.3 1.1 8.6 3.2l6.3-6.3C34.4 3.1 29.6 1 24 1 14.9 1 7.2 6.6 4 14.6l7.7 6C13.1 13.8 18.1 9.5 24 9.5z" />
                    <path fill="#34A853"
                        d="M46.1 24.5c0-1.6-.1-3.1-.4-4.5H24v9h12.5c-.6 3-2.4 5.5-5 7.2l7.7 6c4.5-4.2 7.1-10.3 7.1-17.7z" />
                    <path fill="#FBBC05"
                        d="M11.7 28.7A14.5 14.5 0 0 1 10.3 24c0-1.6.3-3.1.8-4.5l-7.7-6A23.8 23.8 0 0 0 2 24c0 3.9.9 7.6 2.4 10.8l7.3-6.1z" />
                    <path fill="#4285F4"
                        d="M24 47c6.5 0 12-2.1 16-5.8l-7.7-6c-2.1 1.4-4.9 2.3-8.3 2.3-5.9 0-10.9-4.3-12.7-10.1l-7.7 6C7.2 41.4 14.9 47 24 47z" />
                </svg>
                Login dengan Google
            </button>
        </form>


    </div>
    <!-- SweetAlert Notifications -->
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                timer: 2500,
                showConfirmButton: false
            });
        </script>
    @endif

</body>

</html>
