<?php

namespace Database\Factories;

use App\Models\KartuPelajar;
use App\Models\Siswa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<KartuPelajar>
 */
class KartuPelajarFactory extends Factory
{
    protected $model = KartuPelajar::class;

    public function definition(): array
    {
        return [
            // Contoh: KP-2026-XXXXXX
            'nomor_kartu' => 'KP-' . date('Y') . '-' . fake()->unique()->numerify('######'),
            'id_siswa' => Siswa::factory(),
        ];
    }
}
