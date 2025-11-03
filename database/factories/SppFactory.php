<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Spp;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Spp>
 */
class SppFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => function () {
                $user = User::inRandomOrder()->first();

                $bulan = now()->format('F');
                $tahun = now()->year;

                while (Spp::where('user_id', $user->id)
                    ->where('bulan', $bulan)
                    ->where('tahun', $tahun)
                    ->exists()
                ) {
                    $user = User::inRandomOrder()->first();
                }

                return $user->id;
            },
            'bulan' => Carbon::now()->locale('id')->translatedFormat('F'),
            'tahun' => now()->year,
            'nominal' => 600000,
            'status' => 'belum lunas',
            'keterangan' => 'Tagihan SPP bulan ' . now()->format('F Y'),
        ];
    }
}
