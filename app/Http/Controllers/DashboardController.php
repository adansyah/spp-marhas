<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use App\Models\Spp;
use Midtrans\Config;
use Midtrans\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
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
        $spp = Spp::with('user')->findOrFail($id);

        $orderId = 'SPP-' . $spp->id . '-' . time();

        $spp->update(['order_id' => $orderId]);

        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $spp->nominal,
            ],
            'customer_details' => [
                'first_name' => $spp->user->nama,
                'email' => $spp->user->email ?? 'noemail@example.com',
                'phone' => $spp->user->no_telp ?? '08123456789',
            ],
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        return response()->json([
            'orderId' => $orderId,
            'snapToken' => $snapToken,
            'message' => 'Pembayaran Berhasil'
        ]);
    }



    public function markAsLunas($id)
    {
        $spp = Spp::findOrFail($id);
        $spp->status = 'lunas';
        $spp->save();

        return response()->json(['message' => 'Status diperbarui menjadi lunas']);
    }

    public function cetak($id)
    {
        $spp = Spp::with('user')->findOrFail($id);

        // Jika user tidak memiliki hak akses
        if ($spp->user_id !== auth()->id()) {
            return response()->view('errors.privasi', [], 403);
        }

        // Load view invoice
        $pdf = Pdf::loadView('cetak', compact('spp'));

        // Nama file bisa disesuaikan
        $fileName = 'Bukti-SPP-' . $spp->user->nama . '-' . $spp->bulan . '.pdf';

        return $pdf->stream($fileName); // langsung tampil di browser
        // atau return $pdf->download($fileName); untuk langsung download
    }
}
