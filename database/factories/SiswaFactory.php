<?php

namespace Database\Factories;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Siswa>
 */
class SiswaFactory extends Factory
{
    protected $model = Siswa::class;

    public function definition(): array
    {
        return [
            'nama' => fake('id_ID')->unique()->name(),
            'id_kelas' => Kelas::inRandomOrder()->first()?->id ?? Kelas::factory(),
        ];
    }
}
