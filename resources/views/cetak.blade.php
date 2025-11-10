<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Bukti Pembayaran SPP</title>
    <style>
        /* Setting A4 */
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            color: #000;
            background: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
            padding: 10px;
        }

        h1 {
            font-size: 22px;
            margin-bottom: 10px;
            text-align: center;
        }

        h2 {
            font-size: 16px;
            margin-bottom: 5px;
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
        }

        p {
            margin: 2px 0;
            font-size: 14px;
        }

        .flex-between {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .column {
            width: 30%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 14px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 6px;
        }

        th {
            font-weight: bold;
            text-transform: uppercase;
            text-align: center;
        }

        td {
            text-align: center;
        }

        .total {
            margin-top: 15px;
            font-size: 16px;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Bukti Pembayaran SPP MARHAS MARGAHAYU</h1>
        <p>Nomor Invoice: <strong>#SPP{{ str_pad($spp->id, 5, '0', STR_PAD_LEFT) }}</strong></p>
        <p>Tanggal Cetak: {{ now()->translatedFormat('d M Y') }}</p>

        <div class="flex-between">
            <div class="column">
                <h2 style="text-align: center">Data Siswa</h2>
                <p>Nama: {{ $spp->user->nama ?? 'Tidak diketahui' }}</p>
                <p>NIS: {{ $spp->user->nis ?? '-' }}</p>
                <p>Kelas: {{ $spp->user->kelas ?? '-' }}</p>
            </div>
            <div class="column">
                <h2 style="text-align: center">Informasi Tagihan</h2>
                <p>Bulan: {{ $spp->bulan }}</p>
                <p>Tahun: {{ $spp->tahun }}</p>
                <p>Dibuat: {{ $spp->created_at->translatedFormat('d M Y') }}</p>
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Deskripsi</th>
                    <th>Nominal</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Pembayaran SPP Bulan {{ $spp->bulan }} {{ $spp->tahun }}</td>
                    <td>Rp {{ number_format($spp->nominal, 0, ',', '.') }}</td>
                    <td>
                        @if ($spp->status === 'lunas')
                            LUNAS
                        @else
                            BELUM LUNAS
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="total">
            Total Pembayaran: Rp {{ number_format($spp->nominal, 0, ',', '.') }}
        </div>

        <div class="footer">
            Terima kasih telah melakukan pembayaran SPP.<br>
            Sistem Pembayaran Otomatis Sekolah &copy; {{ date('Y') }}
        </div>
    </div>
</body>

</html>
