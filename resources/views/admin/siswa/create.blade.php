@extends('layouts.admin')

@section('title', 'Update Data Siswa')

@section('content')
    <div
        class="max-w-3xl md:max-w-5xl mx-auto  bg-gray-900/80 backdrop-blur-xl text-gray-100 rounded-2xl p-6 shadow-lg border border-gray-700">
        <h2 class="text-2xl font-bold text-indigo-400 flex items-center gap-2 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
            </svg>
            Create Data Siswa
        </h2>

        <form action="{{ route('admin.data-siswa.store') }}" method="post" class="space-y-5">
            @csrf
            <!-- NIS -->
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">NIS</label>
                <input type="text" placeholder="Masukkan NIS" name="nis"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>

            <!-- Nama -->
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Nama Lengkap</label>
                <input type="text" placeholder="Masukkan Nama" name="nama"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Email</label>
                <input type="text" placeholder="Masukkan email" name="email"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>

            <!-- Kelas -->
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Kelas</label>
                <select name="kelas"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
                    <option>Pilih Kelas</option>
                    <option value="RPL 1">RPL 1</option>
                    <option value="RPL 2">RPL 2</option>
                    <option value="RPL 3">RPL 3</option>
                    <option value="TPM 1">TPM 1</option>
                    <option value="TPM 2">TPM 2</option>
                    <option value="TPM 3">TPM 3</option>
                </select>
            </div>

            <!-- Alamat -->
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Alamat</label>
                <textarea rows="3" placeholder="Masukkan Alamat" name="alamat"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition"></textarea>
            </div>

            <!-- No Telp -->
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">No. Telepon</label>
                <input type="text" placeholder="Contoh: 081234567890" name="no_telp"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>

            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Password</label>
                <input type="password" placeholder="Password" name="password"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>
            <div>
                <label class="block text-sm font-semibold mb-1 text-gray-300">Password</label>
                <input type="password" placeholder="Password" name="password_confirmation"
                    class="w-full bg-gray-800/80 border border-gray-700 rounded-lg px-4 py-2 text-gray-100 focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400 outline-none transition">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-3 mt-6">
                <!-- Tombol Batal -->
                <a href="{{ route('admin.data-siswa.index') }}"
                    class="flex items-center gap-2 px-5 py-2 bg-gray-700 hover:bg-gray-600 rounded-lg text-gray-200 transition">
                    <!-- Heroicon X -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    <span>Batal</span>
                </a>

                <!-- Tombol Simpan -->
                <button type="submit"
                    class="cursor-pointer flex items-center gap-2 px-5 py-2 bg-indigo-600 hover:bg-indigo-500 rounded-lg text-white font-semibold transition transform hover:scale-105 hover:shadow-[0_0_12px_#6366f1]">
                    <!-- Heroicon Check -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="1.8">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>Simpan</span>
                </button>
            </div>
        </form>
    </div>


    @if (session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top', // 🔹 posisi atas
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
@endsection
