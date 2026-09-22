<?php

namespace Database\Seeders;

use App\Models\KartuPelajar;
use App\Models\Siswa;
use Illuminate\Database\Seeder;

class KartuPelajarSeeder extends Seeder
{
    public function run(): void
    {
        // Ambil 50 siswa yang belum punya kartu pelajar
        $siswas = Siswa::doesntHave('kartuPelajar')->take(50)->get();

        foreach ($siswas as $siswa) {
            KartuPelajar::factory()->create([
                'id_siswa' => $siswa->id,
            ]);
        }
    }
}
