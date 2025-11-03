<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Spp;
use Carbon\Carbon;

class GenerateSppTagihan extends Command
{
    protected $signature = 'spp:generate';
    protected $description = 'Generate tagihan SPP otomatis untuk semua siswa setiap bulan';

    public function handle()
    {
        $bulan = Carbon::now()->format('F');
        $tahun = Carbon::now()->year;

        $users = User::where('role', 'siswa')->get();
        $count = 0;

        foreach ($users as $user) {
            $exists = Spp::where('user_id', $user->id)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->exists();

            if (!$exists) {
                Spp::create([
                    'user_id' => $user->id,
                    'bulan' => $bulan,
                    'tahun' => $tahun,
                    'nominal' => 250000,
                    'status' => 'belum lunas',
                    'keterangan' => 'Tagihan otomatis bulan ' . $bulan,
                ]);
                $count++;
            }
        }

        $this->info("✅ $count tagihan SPP berhasil dibuat untuk bulan $bulan $tahun.");
    }
}
