<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
            ]
        );

        // Urutan penting karena relasi FK:
        // Kelas (1) -> Siswa (N) -> Kartu Pelajar (1:1)
        // Total: 6 kelas, 50 siswa, 50 kartu pelajar
        $this->call([
            KelasSeeder::class,
            SiswaSeeder::class,
            KartuPelajarSeeder::class,
        ]);
    }
}
