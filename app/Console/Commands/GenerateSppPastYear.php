<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Console\Command;

class GenerateSppPastYear extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spp:generate-past-year {--year= : Tahun yang ingin digenerate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate tagihan SPP otomatis untuk semua siswa tahun sebelumnya';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $tahun = Carbon::now()->subYear()->year;
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

        $users = User::where('role', 'siswa')->get();
        $count = 0;

        foreach ($users as $user) {
            foreach ($bulanList as $bulan) {
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
        }

        $this->info(" $count tagihan SPP berhasil dibuat untuk tahun $tahun.");
    }
}
