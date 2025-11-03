@extends('layouts.admin')

@section('title', 'Data Siswa')

@section('content')
    <div class="bg-gray-900 text-gray-100 rounded-2xl p-6 shadow-lg">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6 gap-4">
            <h2 class="text-2xl font-bold text-indigo-400 flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-indigo-500" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="1.8">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 14l9-5-9-5-9 5 9 5zM12 14v7m0-7l-9-5m9 5l9-5" />
                </svg>
                Data Siswa
            </h2>

            <div class="flex flex-col md:flex-row items-center gap-3 w-full md:w-auto">
                <input type="text" id="searchInput" placeholder="Cari nama atau NIS..."
                    class="bg-gray-800 text-white border border-gray-700 rounded-xl px-4 py-2 w-full md:w-64 focus:ring-2 focus:ring-indigo-500 focus:outline-none placeholder-gray-400">

                <a href="{{ route('admin.data-siswa.create') }}"
                    class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-500 px-5 py-2 rounded-xl text-white font-semibold transition transform ">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    Tambah Siswa
                </a>
            </div>
        </div>

        {{-- 💻 Desktop Table --}}
        <div class="hidden md:block overflow-x-auto rounded-xl border border-gray-700 shadow-inner">
            <table class="min-w-full text-sm text-gray-300" id="dataTable">
                <thead class="bg-gray-800 text-indigo-400 uppercase text-xs tracking-wider">
                    <tr>
                        <th class="px-6 py-3 text-left">No</th>
                        <th class="px-6 py-3 text-left">NIS</th>
                        <th class="px-6 py-3 text-left">Nama</th>
                        <th class="px-6 py-3 text-left">Kelas</th>
                        <th class="px-6 py-3 text-left">Alamat</th>
                        <th class="px-6 py-3 text-left">No. Telp</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @foreach ($siswa as $index => $item)
                        <tr class="hover:bg-gray-800 transition">
                            <td class="px-6 py-3">{{ $index + 1 }}</td>
                            <td class="px-6 py-3">{{ $item->nis }}</td>
                            <td class="px-6 py-3 font-semibold text-white">{{ $item->nama }}</td>
                            <td class="px-6 py-3">{{ $item->kelas }}</td>
                            <td class="px-6 py-3">{{ $item->alamat }}</td>
                            <td class="px-6 py-3">{{ $item->no_telp }}</td>
                            <td class="px-6 py-3 text-center">
                                <div class="flex justify-center gap-2">
                                    <a href="{{ route('admin.data-siswa.edit', $item->nis) }}"
                                        class="bg-emerald-600 hover:bg-emerald-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M15.232 5.232l3.536 3.536M9 11l6 6H3v-6l6-6z" />
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.data-siswa.destroy', $item->nis) }}" method="POST"
                                        class="delete-form inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button"
                                            class="bg-rose-600 hover:bg-rose-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1 delete-btn">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- 📱 Mobile Card View --}}
        <div class="md:hidden space-y-4" id="mobileCards">
            @foreach ($siswa as $item)
                <div class="bg-gray-800 rounded-2xl p-4 shadow-md border border-gray-700 hover:border-indigo-500 transition student-card"
                    data-nis="{{ strtolower($item->nis) }}" data-nama="{{ strtolower($item->nama) }}">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-bold text-indigo-400">{{ $item->nama }}</h3>
                        <span class="text-xs text-gray-400">#{{ $item->nis }}</span>
                    </div>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Kelas:</span> {{ $item->kelas }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Alamat:</span> {{ $item->alamat }}</p>
                    <p class="text-sm mb-3"><span class="font-semibold text-gray-300">No. Telp:</span> {{ $item->no_telp }}
                    </p>
                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.data-siswa.edit', $item->nis) }}"
                            class="cursor-pointer bg-emerald-600 hover:bg-emerald-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.232 5.232l3.536 3.536M9 11l6 6H3v-6l6-6z" />
                            </svg>
                            Edit
                        </a>
                        <form action="{{ route('admin.data-siswa.destroy', $item->nis) }}" method="POST"
                            class="delete-form inline">
                            @csrf
                            @method('DELETE')
                            <button type="button"
                                class="bg-rose-600 hover:bg-rose-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1 delete-btn">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        // 🔍 Fitur Pencarian Realtime
        const searchInput = document.getElementById('searchInput');
        const rows = document.querySelectorAll('#dataTable tbody tr');
        const cards = document.querySelectorAll('.student-card');

        searchInput.addEventListener('keyup', function() {
            const keyword = this.value.toLowerCase();

            // Table (desktop)
            rows.forEach(row => {
                const nama = row.cells[2].textContent.toLowerCase();
                const nis = row.cells[1].textContent.toLowerCase();
                row.style.display = (nama.includes(keyword) || nis.includes(keyword)) ? '' : 'none';
            });

            // Mobile cards
            cards.forEach(card => {
                const nama = card.dataset.nama;
                const nis = card.dataset.nis;
                card.style.display = (nama.includes(keyword) || nis.includes(keyword)) ? '' : 'none';
            });
        });

        // 🔥 Konfirmasi Hapus (SweetAlert)
        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data yang dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
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
@endsection
