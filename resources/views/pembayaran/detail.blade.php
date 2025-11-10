<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Pembayaran SPP</title>
    <link rel="icon" type="image/png" href="{{ asset('marhas.jpg') }}" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="min-h-screen bg-gray-900 text-gray-100 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div
        class="w-full max-w-3xl bg-gray-800/70 backdrop-blur-lg border border-blue-400/30 rounded-2xl shadow-xl shadow-blue-500/30 p-8">

        {{-- Header --}}
        <div class="flex flex-col md:flex-row justify-between items-center border-b border-blue-400/30 pb-4 mb-6">
            <div>
                <h1 class=" text-2xl md:text-3xl font-bold text-blue-400 tracking-wide  md:ml-40 drop-shadow-md">INVOICE
                    PEMBAYARAN
                </h1>
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
                <h2 class="text-lg font-semibold text-blue-300 border-b text-center border-blue-400/20 mb-2">Data Siswa
                </h2>
                <p><span class="text-gray-400">Nama :</span> {{ $spp->user->nama ?? 'Tidak diketahui' }}</p>
                <p><span class="text-gray-400">NIS :</span> {{ $spp->user->nis ?? '-' }}</p>
                <p><span class="text-gray-400">Kelas :</span> {{ $spp->user->kelas ?? '-' }}</p>
            </div>

            <div>
                <h2 class="text-lg font-semibold text-blue-300 border-b text-center border-blue-400/20 mb-2">Informasi
                    Tagihan</h2>
                <p><span class="text-gray-400">Bulan :</span> {{ $spp->bulan }}</p>
                <p><span class="text-gray-400">Tahun :</span> {{ $spp->tahun }}</p>
                <p><span class="text-gray-400">Dibuat :</span> {{ $spp->created_at->translatedFormat('d M Y') }}</p>
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
                            <span class="inline-block px-3 py-1 text-sm font-bold text-emerald-400 rounded-full ">
                                Lunas
                            </span>
                        @else
                            <span
                                class="inline-block px-3 py-1 text-sm font-bold text-rose-400  rounded-full \">
                                Belum Lunas
                            </span>
@endif
                    </td>
                </tr>
            </tbody>
        </table>

        {{-- Total & Tombol Bayar --}}
                                <div class="flex
                                flex-col md:flex-row justify-between items-center border-t border-blue-400/30 pt-4">
                                <div class="text-lg font-semibold text-gray-300 mb-4 md:mb-0">
                                    Total Pembayaran:
                                    <span class="text-blue-400 ml-2">Rp
                                        {{ number_format($spp->nominal, 0, ',', '.') }}</span>
                                </div>

                                @if ($spp->status !== 'lunas')
                                    <div class="mt-8 text-center">
                                        <button id="pay-button"
                                            class="cursor-pointer px-6 py-2 bg-blue-700 hover:bg-blue-600 text-white rounded-xl font-semibold shadow-lg  transition-all duration-200">
                                            💳 Bayar Sekarang
                                        </button>
                                    </div>
                                    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
                                        data-client-key="{{ config('midtrans.client_key') }}"></script>

                                    <script>
                                        document.getElementById('pay-button').onclick = function() {
                                            fetch("{{ route('detail.bayar', $spp->id) }}", {
                                                    method: "POST",
                                                    headers: {
                                                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                                                        "Content-Type": "application/json"
                                                    }
                                                })
                                                .then(response => response.json())
                                                .then(data => {
                                                    if (!data.snapToken) {
                                                        Swal.fire({
                                                            icon: 'error',
                                                            title: 'Gagal Membuat Transaksi',
                                                            text: data.error || 'Token pembayaran tidak ditemukan.',
                                                            confirmButtonColor: '#3085d6',
                                                        });
                                                        return;
                                                    }

                                                    snap.pay(data.snapToken, {
                                                        onSuccess: function(result) {
                                                            fetch("/spp/{{ $spp->id }}/lunas", {
                                                                method: "POST",
                                                                headers: {
                                                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                                }
                                                            }).then(() => {
                                                                Swal.fire({
                                                                    icon: 'success',
                                                                    title: 'Pembayaran Berhasil!',
                                                                    text: 'Status tagihan sudah menjadi Lunas ✅',
                                                                    confirmButtonColor: '#3085d6',
                                                                }).then(() => {
                                                                    window.location.href = "/dashboard";
                                                                });
                                                            });
                                                        },
                                                        onPending: function(result) {
                                                            Swal.fire({
                                                                icon: 'info',
                                                                title: 'Menunggu Pembayaran',
                                                                text: 'Silakan selesaikan pembayaranmu untuk melanjutkan.',
                                                                confirmButtonColor: '#3085d6',
                                                            });
                                                        },
                                                        onError: function(result) {
                                                            Swal.fire({
                                                                icon: 'error',
                                                                title: 'Gagal Membayar',
                                                                text: 'Terjadi kesalahan saat memproses pembayaran ❌',
                                                                confirmButtonColor: '#d33',
                                                            });
                                                        },
                                                        onClose: function() {
                                                            Swal.fire({
                                                                icon: 'warning',
                                                                title: 'Pembayaran Dibatalkan',
                                                                text: 'Kamu menutup pembayaran. Silakan coba lagi.',
                                                                confirmButtonColor: '#3085d6',
                                                            }).then(() => {
                                                                window.location.href = "/dashboard";
                                                            });
                                                        }
                                                    });
                                                })
                                                .catch(error => {
                                                    Swal.fire({
                                                        icon: 'error',
                                                        title: 'Terjadi Kesalahan',
                                                        text: error.message,
                                                        confirmButtonColor: '#d33',
                                                    });
                                                });
                                        };
                                    </script>
                                @elseif($spp->status === 'lunas')
                                    <a href="{{ route('dashboard') }}"
                                        class="cursor-pointer px-6 py-2 bg-blue-700 hover:bg-blue-600 text-white rounded-xl font-semibold shadow-lg  transition-all duration-200">
                                        Kembali
                                    </a>
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
