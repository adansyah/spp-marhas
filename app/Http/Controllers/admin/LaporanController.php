<?php

namespace App\Http\Controllers\admin;

use App\Models\Spp;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;

class LaporanController extends Controller
{
    public function laporan(Request $request)
    {
        // Ambil data SPP dengan filter (jika ada)
        $spp = Spp::with('user')
            ->when($request->nama, fn($q) => $q->whereHas('user', fn($u) => $u->where('nama', 'like', '%' . $request->nama . '%')))
            ->when($request->bulan, fn($q) => $q->where('bulan', $request->bulan))
            ->when($request->tahun, fn($q) => $q->where('tahun', $request->tahun))
            ->get();

        // Array bulan
        $bulanList = [
            'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des'
        ];

        // Array tahun (misal 2023-2025)
        $tahunList = range(2023, now()->year);

        return view('admin.laporan', compact('spp', 'bulanList', 'tahunList'));
    }

    public function cetakLaporan($id)
    {
        // Ambil data SPP berdasarkan ID dengan relasi user
        $spp = Spp::with('user')->findOrFail($id);

        // Load view cetak per ID
        $pdf = Pdf::loadView('admin.cetak', compact('spp'));

        // Nama file PDF bisa pakai nama siswa & bulan
        $fileName = 'Bukti-SPP-' . $spp->user->nama . '-' . $spp->bulan . '.pdf';

        // Tampilkan PDF di browser
        return $pdf->stream($fileName);
    }
}
