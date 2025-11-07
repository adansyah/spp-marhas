<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spp;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class PaymentController extends Controller
{
    public function bayar(Request $request, $id)
    {
        $spp = Spp::findOrFail($id);

        // Setup konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $params = [
            'transaction_details' => [
                'order_id' => 'SPP-' . $spp->id . '-' . time(),
                'gross_amount' => $spp->nominal,
            ],
            'customer_details' => [
                'first_name' => $spp->user->nama,
                'email' => $spp->user->email ?? 'noemail@example.com',
                'phone' => $spp->user->no_telp ?? '08123456789',
            ],
        ];

        // Dapatkan Snap Token
        $snapToken = Snap::getSnapToken($params);

        return view('admin.data-spp.bayar', compact('spp', 'snapToken'));
    }

    // Callback dari Midtrans
    public function callback(Request $request)
    {
        $notif = new Notification();

        $order_id = $notif->order_id;
        $status = $notif->transaction_status;

        $id = explode('-', $order_id)[1];
        $spp = Spp::find($id);

        if (!$spp) return;

        if ($status == 'capture' || $status == 'settlement') {
            $spp->update(['status' => 'lunas']);
        } else if ($status == 'cancel' || $status == 'expire' || $status == 'deny') {
            $spp->update(['status' => 'belum lunas']);
        }
    }
}
