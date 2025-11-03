<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-900 flex items-center justify-center min-h-screen">

    <div class="bg-gray-800 rounded-2xl shadow-lg p-8 w-full max-w-md border border-gray-700">
        <!-- Header -->
        <h2 class="text-3xl font-bold text-indigo-400 text-center mb-6 flex items-center justify-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2" />
                <circle cx="12" cy="7" r="4" stroke="currentColor" stroke-width="2" />
            </svg>
            Admin Login
        </h2>

        <!-- Form -->
        <form action="{{ route('admin.prosesLogin') }}" method="POST" class="space-y-5">
            @csrf
            <!-- Email -->
            <div>
                <label for="email" class="block text-gray-300 font-semibold mb-1">Email</label>
                <input type="email" id="email" name="email" placeholder="admin@example.com" required
                    class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 outline-none transition">
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-gray-300 font-semibold mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="********" required
                    class="w-full bg-gray-700 border border-gray-600 rounded-xl px-4 py-2 text-white placeholder-gray-400 focus:ring-2 focus:ring-indigo-400 outline-none transition">
            </div>

            <!-- Submit Button -->
            <button type="submit"
                class="w-full bg-indigo-600 hover:bg-indigo-500 text-white font-semibold px-4 py-2 rounded-xl shadow-md transition transform ">
                Login
            </button>
        </form>

        <!-- Footer -->
        <p class="text-gray-400 text-sm text-center mt-6">&copy; 2025 Admin Panel</p>
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
