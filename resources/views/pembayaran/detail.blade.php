<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran SPP</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-900 text-gray-100 flex items-center justify-center py-12">
    <div
        class="w-full max-w-3xl bg-gray-800/70 backdrop-blur-lg border border-blue-400/30 rounded-2xl shadow-xl shadow-blue-500/30 p-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-center border-b border-blue-400/30 pb-4 mb-6">
            <div>
                <h1 class="text-3xl font-bold text-blue-400 tracking-wide drop-shadow-md">INVOICE SPP</h1>
                <p class="text-sm text-gray-400 mt-1">Nomor Invoice: <span
                        class="text-blue-300 font-semibold">#SPP{{ str_pad($spp->id, 5, '0', STR_PAD_LEFT) }}</span></p>
            </div>
            <div class="text-right mt-4 md:mt-0">
                <p class="text-sm text-gray-400">Tanggal Cetak:</p>
                <p class="font-semibold text-blue-300">{{ now()->translatedFormat('d M Y') }}</p>
            </div>
        </div>

        {{-- Informasi Siswa --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <h2 class="text-lg font-semibold text-blue-300 border-b border-blue-400/20 mb-2">Data Siswa</h2>
                <p><span class="text-gray-400">Nama:</span> {{ $spp->user->nama ?? 'Tidak diketahui' }}</p>
                <p><span class="text-gray-400">NIS:</span> {{ $spp->user->nis ?? '-' }}</p>
                <p><span class="text-gray-400">Kelas:</span> {{ $spp->user->kelas ?? '-' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-blue-300 border-b border-blue-400/20 mb-2">Informasi Tagihan</h2>
                <p><span class="text-gray-400">Bulan:</span> {{ $spp->bulan }}</p>
                <p><span class="text-gray-400">Tahun:</span> {{ $spp->tahun }}</p>
                <p><span class="text-gray-400">Dibuat:</span> {{ $spp->created_at->translatedFormat('d M Y') }}</p>
            </div>
        </div>

        {{-- Tabel Tagihan --}}
        <table class="w-full border border-blue-400/30 rounded-xl overflow-hidden mb-6 text-sm md:text-base">
            <thead>
                <tr class="bg-blue-600/20 text-blue-300 uppercase tracking-wider">
                    <th class="px-4 py-3 text-left">Deskripsi</th>
                    <th class="px-4 py-3 text-right">Nominal</th>
                    <th class="px-4 py-3 text-center">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-t border-blue-400/20 hover:bg-blue-900/20 transition duration-200 ease-in-out">
                    <td class="px-4 py-3">Pembayaran SPP Bulan {{ $spp->bulan }} {{ $spp->tahun }}</td>
                    <td class="px-4 py-3 text-right text-blue-200 font-semibold">
                        Rp {{ number_format($spp->nominal, 0, ',', '.') }}
                    </td>
                    <td class="px-4 py-3 text-center">
                        @if ($spp->status === 'lunas')
                            <span
                                class="inline-block px-3 py-1 text-sm font-semibold text-green-100 bg-green-600/70 rounded-full shadow-green-400/40 shadow">
                                ✅ Lunas
                            </span>
                        @else
                            <span
                                class="inline-block px-3 py-1 text-sm font-semibold text-yellow-100 bg-yellow-600/70 rounded-full shadow-yellow-400/40 shadow">
                                🕓 Belum Lunas
                            </span>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Total & Tombol Bayar --}}
        <div class="flex flex-col md:flex-row justify-between items-center border-t border-blue-400/30 pt-4">
            <div class="text-lg font-semibold text-gray-300 mb-4 md:mb-0">
                Total Pembayaran:
                <span class="text-blue-400 ml-2">Rp {{ number_format($spp->nominal, 0, ',', '.') }}</span>
            </div>

            @if ($spp->status !== 'lunas')
                <div class="mt-8 text-center">
                    <form action="{{ route('detail.bayar', $spp->id) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="cursor-pointer px-6 py-2 bg-blue-700 hover:bg-blue-600 text-white rounded-xl font-semibold shadow-lg  transition-all duration-200">
                            💳 Bayar Sekarang
                        </button>
                    </form>
                </div>
            @endif
        </div>

        {{-- Footer --}}
        <div class="mt-10 text-center text-gray-500 text-xs border-t border-blue-400/20 pt-4">
            Terima kasih telah melakukan pembayaran SPP. <br>
            Sistem Pembayaran Otomatis Sekolah &copy; {{ date('Y') }}
        </div>
    </div>
</body>

</html>
