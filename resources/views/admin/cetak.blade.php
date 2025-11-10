<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Bukti SPP</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 14px;
            line-height: 1.5;
            color: #333;
            padding: 20px;
        }

        .container {
            max-width: 500px;
            margin: auto;
            border: 1px solid #333;
            padding: 20px;
            border-radius: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 10px;
        }

        .header h2 {
            margin: 0;
            /* Indigo */
            font-size: 20px;
        }

        .field {
            margin-bottom: 12px;
        }

        .field-label {
            font-weight: bold;
            width: 120px;
            display: inline-block;
        }

        .status-lunas {
            color: green;
            font-weight: bold;
        }

        .status-belum {
            color: red;
            font-weight: bold;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }

        .signature {
            margin-top: 30px;
            display: flex;
            justify-content: flex-end;
            flex-direction: column;
            align-items: center;
        }

        .signature span {
            display: block;
            margin-top: 60px;
            /* untuk tanda tangan */
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- HEADER DENGAN LOGO -->
        <div class="header">
            <img src="{{ public_path('marhas.jpg') }}" alt="Logo Sekolah">
            <h2>Bukti Pembayaran SPP</h2>
            <small>SMK MARHAS MARGAHAYU</small>
        </div>

        <!-- INFORMASI PEMBAYARAN -->
        <div class="field">
            <span class="field-label">Order ID:</span>
            <span>{{ $spp->order_id ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">Nama Siswa:</span>
            <span>{{ $spp->user->nama ?? '-' }}</span>
        </div>

        <div class="field">
            <span class="field-label">Bulan:</span>
            <span>{{ $spp->bulan }}</span>
        </div>

        <div class="field">
            <span class="field-label">Tahun:</span>
            <span>{{ $spp->tahun }}</span>
        </div>

        <div class="field">
            <span class="field-label">Nominal:</span>
            <span>Rp {{ number_format($spp->nominal, 0, ',', '.') }}</span>
        </div>

        <div class="field">
            <span class="field-label">Tanggal:</span>
            <span>{{ $spp->created_at->translatedFormat('d F Y') }}</span>
        </div>

        <div class="field">
            <span class="field-label">Status:</span>
            <span class="{{ $spp->status === 'lunas' ? 'status-lunas' : 'status-belum' }}">
                {{ $spp->status === 'lunas' ? 'Lunas' : 'Belum Lunas' }}
            </span>
        </div>

        <!-- FOOTER DENGAN TANDA TANGAN -->
        <div class="signature">
            <span>Kepala Sekolah</span>



            <span>............</span>
        </div>

        <div class="footer">
            Terima kasih telah melakukan pembayaran SPP. Simpan bukti ini sebagai referensi.
        </div>
    </div>
</body>

</html>
