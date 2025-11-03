<?php

namespace Database\Seeders;

use App\Models\Spp;
use App\Models\User;
use App\Models\Payment;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Buat satu admin
        User::factory()->create([
            'nis' => 'ADMIN001',
            'nama' => 'Administrator',
            'kelas' => '-',
            'alamat' => 'Kantor Sekolah',
            'role' => 'admin',
            'email' => 'admin@spp.test',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'nis' => '23110065',
            'nama' => 'syahdan',
            'kelas' => 'RPL 3',
            'alamat' => 'Kopo',
            'role' => 'siswa',
            'email' => 'adansyah225@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        // Buat 10 siswa
        User::factory(10)->create();

        // Buat 20 data SPP acak
        // Spp::factory(10)->create();

        // Buat 30 data pembayaran acak
        // Payment::factory(10)->create();
    }
}
