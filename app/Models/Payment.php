<?php

namespace App\Models;

use App\Models\PaymentCicilan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'spp_id',
        'jumlah_bayar',
        'bulan',
        'status',
    ];

    // 🔗 Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relasi ke spp
    public function spp()
    {
        return $this->belongsTo(Spp::class);
    }

    // 🔗 Relasi ke payment cicilan

}
