<?php

namespace App\Http\Controllers\admin;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SppController extends Controller
{

    public function index(Request $request)
    {
        $this->generateSppOtomatis();

        $query = Spp::with('user');

        if ($request->filled('nama')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->nama . '%');
            });
        }

        if ($request->bulan) {
            $query->where('bulan', $request->bulan);
        }

        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        if ($request->status) {
            $query->where('status', strtolower($request->status));
        }

        $spp = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();

        $spp = $query->latest()->get();

        $bulanList = [
            'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        ];
        $tahunList = range(date('Y') - 5, date('Y'));

        return view('admin.data-spp', compact('spp', 'bulanList', 'tahunList'));
    }

    private function generateSppOtomatis()
    {
        $bulanSekarang = Carbon::now()->translatedFormat('F');
        $tahunSekarang = Carbon::now()->year;

        $siswa = User::where('role', 'siswa')->get();

        foreach ($siswa as $item) {
            $sudahAda = Spp::where('user_id', $item->id)
                ->where('bulan', $bulanSekarang)
                ->where('tahun', $tahunSekarang)
                ->exists();

            if (! $sudahAda) {
                Spp::create([
                    'user_id' => $item->id,
                    'bulan' => $bulanSekarang,
                    'tahun' => $tahunSekarang,
                    'nominal' => 250000,
                    'status' => 'belum lunas',
                    'keterangan' => null,
                ]);
            }
        }
    }

    public function updateStatus($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->status = $spp->status === 'lunas' ? 'belum lunas' : 'lunas';
        $spp->save();

        return back()->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->delete();

        return redirect()->route('admin.data-spp.index')->with('success', 'Data SPP berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $query = Spp::with('user');

        // Filter berdasarkan nama siswa / NIS
        if ($request->nama) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('nama', 'like', "%{$request->nama}%")
                    ->orWhere('nis', 'like', "%{$request->nama}%");
            });
        }

        // Filter berdasarkan bulan
        if ($request->bulan) {
            $query->where('bulan', 'like', "%{$request->bulan}%");
        }

        // Filter berdasarkan tahun
        if ($request->tahun) {
            $query->where('tahun', $request->tahun);
        }

        // Filter berdasarkan status
        if ($request->status) {
            $query->where('status', $request->status);
        }

        $spp = $query->orderBy('created_at', 'desc')->get();

        return view('admin.table', compact('spp'));
    }
}
