<?php

namespace App\Http\Controllers;

use App\Models\Spp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $spp = Spp::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $bulanBelumLunas = Spp::where('user_id', $user->id)
            ->where('status', 'belum lunas')
            ->pluck('bulan');

        return view('dashboard', compact('spp', 'bulanBelumLunas'));
    }

    public function detail($id)
    {
        $spp = Spp::with('user')->findOrFail($id);

        if ($spp->user_id !== auth()->id()) {
            return response()->view('errors.privasi', [], 403);
        }

        $item = Spp::where('user_id', $spp->user_id)->get();

        return view('pembayaran.detail', compact('spp', 'item'));
    }

    public function bayar($id)
    {
        $spp = Spp::findOrFail($id);

        if ($spp->status !== 'lunas') {
            $spp->update(['status' => 'lunas']);
        }

        return redirect()->route('dashboard')->with('success', 'Pembayaran berhasil! Status sudah berubah menjadi lunas.');
    }
}
