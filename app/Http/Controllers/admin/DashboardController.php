<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'siswa')->count();

        $grafikSPP = Spp::select(
            DB::raw('MONTH(created_at) as bulan'),
            DB::raw('SUM(nominal) as total'),
            DB::raw('MIN(created_at) as tanggal')
        )
            ->where('status', 'lunas')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('MONTH(created_at)'))
            ->get();

        $namaBulan = [
            1 => 'Jan',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Apr',
            5 => 'Mei',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Agu',
            9 => 'Sep',
            10 => 'Okt',
            11 => 'Nov',
            12 => 'Des'
        ];

        $bulanLabels = [];
        $dataNominal = [];
        $dataPerBulan = $grafikSPP->pluck('total', 'bulan')->toArray();

        for ($i = 1; $i <= 12; $i++) {
            $bulanLabels[] = $namaBulan[$i];
            $dataNominal[] = $dataPerBulan[$i] ?? 0; // 0 jika belum ada pembayaran
        }

        $penghasilanBulanIni = Spp::where('status', 'lunas')
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('nominal');

        return view('admin.dashboard', compact(
            'user',
            'penghasilanBulanIni',
            'bulanLabels',
            'dataNominal'
        ));
    }
}
