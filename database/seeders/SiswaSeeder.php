<?php

namespace Database\Seeders;

use App\Models\Siswa;
use Illuminate\Database\Seeder;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        // Top-up sampai 50 agar aman dijalankan berulang (tidak duplikat tiap db:seed)
        $kurang = 50 - Siswa::count();

        if ($kurang > 0) {
            Siswa::factory($kurang)->create();
        }
    }
}
