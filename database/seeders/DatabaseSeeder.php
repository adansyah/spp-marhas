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
            'nama' => 'Syahdan',
            'kelas' => 'RPL 3',
            'alamat' => 'Kopo',
            'role' => 'siswa',
            'email' => 'adansyah225@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'nis' => '23110066',
            'nama' => 'Alya',
            'kelas' => 'RPL 3',
            'alamat' => 'Cibiru',
            'role' => 'siswa',
            'email' => 'alya2@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'nis' => '23110067',
            'nama' => 'Rafi',
            'kelas' => 'RPL 2',
            'alamat' => 'Buahbatu',
            'role' => 'siswa',
            'email' => 'rafi3@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'nis' => '23110068',
            'nama' => 'Nadia',
            'kelas' => 'RPL 2',
            'alamat' => 'Antapani',
            'role' => 'siswa',
            'email' => 'nadia4@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        User::factory()->create([
            'nis' => '23110069',
            'nama' => 'Fikri',
            'kelas' => 'RPL 1',
            'alamat' => 'Margahayu',
            'role' => 'siswa',
            'email' => 'fikri5@gmail.com',
            'password' => bcrypt('admin123'),
        ]);

        // // Buat 10 siswa
        // User::factory(10)->create();

        // Buat 20 data SPP acak
        // Spp::factory(10)->create();

        // Buat 30 data pembayaran acak
        // Payment::factory(10)->create();
    }
}
