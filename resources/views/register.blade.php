<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SPP Payment App | Register</title>
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
        <h1 class="text-3xl font-bold text-center mb-6">Daftar</h1>
        <!-- REGISTER FORM -->
        <form action="{{ route('register.store') }}" method="post" class="space-y-4">
            @csrf

            {{-- Nama & NIS --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Lengkap</label>
                    <input type="text" id="regNama" name="nama" value="{{ old('nama') }}"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
                @error('nama') border-red-500 @else border-gray-700 @enderror 
                focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Nama lengkap" required />
                    @error('nama')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">NIS</label>
                    <input type="text" id="regNIS" name="nis" value="{{ old('nis') }}"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
                @error('nis') border-red-500 @else border-gray-700 @enderror 
                focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Masukkan NIS" required />
                    @error('nis')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Kelas & Alamat --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold mb-1">Kelas</label>
                    <select id="regKelas" name="kelas"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
            @error('kelas') border-red-500 @else border-gray-700 @enderror 
            focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        required>
                        <option value="">-- Pilih Kelas --</option>
                        <option value="RPL 1" {{ old('kelas') == 'RPL 1' ? 'selected' : '' }}>RPL 1</option>
                        <option value="RPL 2" {{ old('kelas') == 'RPL 2' ? 'selected' : '' }}>RPL 2</option>
                        <option value="RPL 3" {{ old('kelas') == 'RPL 3' ? 'selected' : '' }}>RPL 3</option>
                        <option value="TPM 1" {{ old('kelas') == 'TPM 1' ? 'selected' : '' }}>TPM 1</option>
                        <option value="TPM 2" {{ old('kelas') == 'TPM 2' ? 'selected' : '' }}>TPM 2</option>
                        <option value="TPM 3" {{ old('kelas') == 'TPM 3' ? 'selected' : '' }}>TPM 3</option>
                    </select>
                    @error('kelas')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label class="block text-sm font-semibold mb-1">Alamat</label>
                    <textarea id="regAlamat" name="alamat"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
            @error('alamat') border-red-500 @else border-gray-700 @enderror 
            focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Alamat lengkap kamu" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>


            {{-- Telepon & Email --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold mb-1">Telepon</label>
                    <input type="tel" id="regtelepon" name="no_telp" value="{{ old('no_telp') }}"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
               @error('no_telp') border-red-500 @else border-gray-700 @enderror 
               focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Telepon" required pattern="[0-9]*" inputmode="numeric"
                        oninput="this.value = this.value.replace(/[^0-9]/g, '')" />
                    @error('no_telp')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div>
                    <label class="block text-sm font-semibold mb-1">Email</label>
                    <input type="email" id="regEmail" name="email" value="{{ old('email') }}"
                        class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
                @error('email') border-red-500 @else border-gray-700 @enderror 
                focus:ring-2 focus:ring-blue-400 focus:outline-none"
                        placeholder="Email aktif" required />
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Password --}}
            <div>
                <label class="block text-sm font-semibold mb-1">Password</label>
                <input type="password" id="regPassword" name="password"
                    class="w-full px-4 py-2 rounded-lg bg-gray-900 border 
            @error('password') border-red-500 @else border-gray-700 @enderror 
            focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Buat password" required />
                @error('password')
                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1">Konfirmasi Password</label>
                <input type="password" id="regPasswordConfirm" name="password_confirmation"
                    class="w-full px-4 py-2 rounded-lg bg-gray-900 border border-gray-700 
            focus:ring-2 focus:ring-blue-400 focus:outline-none"
                    placeholder="Ulangi password" required />
            </div>

            {{-- Tombol Daftar --}}
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition shadow-lg shadow-blue-500/30 cursor-pointer">
                Daftar
            </button>

            <p class="text-center text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}">
                    <span class="font-semibold cursor-pointer hover:underline text-blue-400">Login</span>
                </a>
            </p>
        </form>

    </div>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
            });
        </script>
    @endif
</body>

</html>
