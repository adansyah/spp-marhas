@extends('layouts.admin')

@section('title', 'Data SPP')

@section('content')
    <div class="p-4 md:p-6">

        <!-- 🔍 FILTER -->
        <form method="GET"
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-8 bg-gray-900/60 p-5 rounded-2xl border border-gray-700/40">
            <h2 class="text-xl font-bold text-indigo-400 flex items-center gap-2 mb-2 md:mb-0">


            </h2>

            <div class="flex flex-wrap gap-3">
                <input type="text" name="nama" placeholder="Nama Siswa" value="{{ request('nama') }}"
                    class="bg-gray-800/70 text-white rounded-xl px-4 py-2" />

                <select name="bulan" class="bg-gray-800/70 text-white rounded-xl px-4 py-2">
                    <option value="">Pilih Bulan</option>
                    @foreach ($bulanList as $bulan)
                        <option value="{{ $bulan }}" {{ request('bulan') == $bulan ? 'selected' : '' }}>
                            {{ $bulan }}</option>
                    @endforeach
                </select>

                <select name="tahun" class="bg-gray-800/70 text-white rounded-xl px-4 py-2">
                    <option value="">Pilih Tahun</option>
                    @foreach ($tahunList as $tahun)
                        <option value="{{ $tahun }}" {{ request('tahun') == $tahun ? 'selected' : '' }}>
                            {{ $tahun }}</option>
                    @endforeach
                </select>

                <select name="status" class="bg-gray-800/70 text-white rounded-xl px-4 py-2">
                    <option value="">Pilih Status</option>
                    <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                    <option value="belum lunas" {{ request('status') == 'belum lunas' ? 'selected' : '' }}>Belum Lunas
                    </option>
                </select>

                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold px-6 py-2 rounded-xl shadow-md cursor-pointer">
                    Cari
                </button>
            </div>
        </form>

        <!-- 💻 TABLE -->
        <div class="hidden md:block overflow-x-auto bg-gray-900/60 rounded-2xl border border-gray-700/30">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-800/80 text-indigo-400 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Nama Siswa</th>
                        <th class="px-6 py-3 text-left">Bulan</th>
                        <th class="px-6 py-3 text-left">Tahun</th>
                        <th class="px-6 py-3 text-left">Nominal</th>
                        <th class="px-6 py-3 text-left">Status</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($spp as $item)
                        <tr class="border-b border-gray-700/40 hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4">{{ $item->user->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->bulan }}</td>
                            <td class="px-6 py-4">{{ $item->tahun }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                <span
                                    class="{{ $item->status === 'lunas' ? 'bg-emerald-500/20 text-emerald-400' : 'bg-rose-500/20 text-rose-400' }} px-3 py-1 rounded-full text-xs font-medium">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $item->created_at->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.data-spp.status', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button"
                                            class="bg-emerald-600 hover:bg-emerald-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1 update-status-btn"
                                            data-id="{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15.232 5.232l3.536 3.536M9 11l6 6H3v-6l6-6z" />
                                            </svg>
                                            Ubah Status
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.data-spp.destroy', $item->id) }}" method="POST"
                                        class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="bg-rose-600 hover:bg-rose-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1">
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
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-gray-400 py-6">Belum ada data SPP</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>


        {{-- 📱 Mobile Card View SPP seperti Data Siswa --}}
        <div class="md:hidden space-y-4">
            @foreach ($spp as $item)
                <div
                    class="bg-gray-800 rounded-2xl p-4 shadow-md border border-gray-700 hover:border-indigo-500 transition">
                    <div class="flex justify-between items-center mb-2">
                        <h3 class="text-lg font-bold text-indigo-400">{{ $item->user->nama ?? '-' }}</h3>
                        <span class="text-xs text-gray-400">#{{ $item->user->nis ?? '-' }}</span>
                    </div>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Bulan:</span> {{ $item->bulan }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Tahun:</span> {{ $item->tahun }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Nominal:</span> Rp
                        {{ number_format($item->nominal, 0, ',', '.') }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Status:</span>
                        <span
                            class="{{ $item->status === 'lunas' ? 'text-emerald-400' : 'text-rose-400' }}">{{ ucfirst($item->status) }}</span>
                    </p>
                    <p class="text-sm mb-3"><span class="font-semibold text-gray-300">Tanggal:</span>
                        {{ $item->created_at->translatedFormat('d F Y') }}</p>

                    {{-- Tombol aksi di bawah card, full width flex --}}
                    <div class="flex justify-end gap-2 mt-2">
                        <form action="{{ route('admin.data-spp.status', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('PUT')
                            <button type="submit"
                                class="bg-emerald-600 hover:bg-emerald-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15.232 5.232l3.536 3.536M9 11l6 6H3v-6l6-6z" />
                                </svg>
                                Ubah Status
                            </button>
                        </form>

                        <form action="{{ route('admin.data-spp.destroy', $item->id) }}" method="POST"
                            class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="bg-rose-600 hover:bg-rose-500 px-3 py-1 rounded-lg text-white text-xs flex items-center gap-1">
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

            @if ($spp->isEmpty())
                <p class="text-gray-400 text-center py-6">Belum ada data SPP</p>
            @endif
        </div>
    </div>








    <!-- SweetAlert -->
    <script>
        document.querySelectorAll('.update-status-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const form = this.closest('form');

                Swal.fire({
                    title: 'Ubah Status?',
                    text: "Apakah kamu yakin ingin mengubah status SPP ini?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, ubah!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
        document.querySelectorAll('.delete-form').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin ingin menghapus?',
                    text: "Data SPP ini akan dihapus permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) form.submit();
                });
            });
        });
    </script>
@endsection
