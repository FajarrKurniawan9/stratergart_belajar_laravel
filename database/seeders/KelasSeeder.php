<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
    public function run(): void
    {
        $daftarKelas = [
            'X RPL 1',
            'X TKJ 1',
            'XI RPL 1',
            'XI TKJ 1',
            'XII RPL 1',
            'XII TKJ 1',
        ];

        foreach ($daftarKelas as $namaKelas) {
            Kelas::firstOrCreate(['nama_kelas' => $namaKelas]);
        }
    }
}
