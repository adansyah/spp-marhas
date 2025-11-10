@extends('layouts.admin')

@section('title', 'Laporan SPP')

@section('content')
    <div class="p-4 md:p-2">
        <!-- 🔍 FILTER -->
        <form method="GET"
            class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-8 bg-gray-900/60 p-5 rounded-2xl border border-gray-700/40">
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

                <button
                    class="bg-indigo-500 hover:bg-indigo-600 text-white font-semibold px-6 py-2 rounded-xl shadow-md cursor-pointer">
                    Cari
                </button>
            </div>
        </form>

        <!-- 💻 TABLE DESKTOP -->
        <div class="hidden md:block overflow-x-auto bg-gray-900/60 rounded-2xl border border-gray-700/30">
            <table class="min-w-full text-sm text-gray-300">
                <thead class="bg-gray-800/80 text-indigo-400 uppercase text-xs">
                    <tr>
                        <th class="px-6 py-3 text-left">Order ID</th>
                        <th class="px-6 py-3 text-left">Nama Siswa</th>
                        <th class="px-6 py-3 text-left">Bulan</th>
                        <th class="px-6 py-3 text-left">Tahun</th>
                        <th class="px-6 py-3 text-left">Nominal</th>
                        <th class="px-6 py-3 text-left">Tanggal</th>
                        <th class="px-6 py-3 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($spp as $item)
                        <tr class="border-b border-gray-700/40 hover:bg-gray-800/50 transition">
                            <td class="px-6 py-4">{{ $item->order_id ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->user->nama ?? '-' }}</td>
                            <td class="px-6 py-4">{{ $item->bulan }}</td>
                            <td class="px-6 py-4">{{ $item->tahun }}</td>
                            <td class="px-6 py-4">Rp {{ number_format($item->nominal, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">{{ $item->created_at->translatedFormat('d F Y') }}</td>
                            <td class="px-6 py-4">
                                <a href="{{ route('admin.laporan-spp.export', $item->id) }}" target="_blank"
                                    class="inline-flex items-center justify-center gap-1 bg-rose-500 hover:bg-rose-600 text-white text-xs font-semibold px-3 py-1 rounded-lg transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        class="h-4 w-4" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
                                    </svg>
                                    <span>Cetak</span>
                                </a>
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

        <!-- 📱 MOBILE VIEW -->
        <div class="md:hidden space-y-4">
            @foreach ($spp as $item)
                <div
                    class="bg-gray-800 rounded-2xl p-4 shadow-md border border-gray-700 hover:border-indigo-500 transition">
                    <p class="text-sm"><span class="font-semibold text-gray-300">Order ID:</span>
                        {{ $item->order_id ?? '-' }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Nama:</span>
                        {{ $item->user->nama ?? '-' }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Bulan:</span> {{ $item->bulan }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Tahun:</span> {{ $item->tahun }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Nominal:</span> Rp
                        {{ number_format($item->nominal, 0, ',', '.') }}</p>
                    <p class="text-sm"><span class="font-semibold text-gray-300">Tanggal:</span>
                        {{ $item->created_at->translatedFormat('d F Y') }}</p>
                </div>
            @endforeach

            @if ($spp->isEmpty())
                <p class="text-gray-400 text-center py-6">Belum ada data SPP</p>
            @endif
        </div>
    </div>
@endsection
