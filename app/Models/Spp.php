<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Spp extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'bulan',
        'tahun',
        'nominal',
        'keterangan',
        'status'
    ];

    // 🔗 Relasi ke user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 🔗 Relasi ke payment
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
