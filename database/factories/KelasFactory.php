<?php

namespace Database\Factories;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Kelas>
 */
class KelasFactory extends Factory
{
    protected $model = Kelas::class;

    public function definition(): array
    {
        $tingkat = $this->faker->randomElement(['X', 'XI', 'XII']);
        $jurusan = $this->faker->randomElement(['RPL', 'TKJ', 'MM', 'OTKP', 'AKL', 'BDP']);
        $rombel = $this->faker->numberBetween(1, 4);

        return [
            'nama_kelas' => "{$tingkat} {$jurusan} {$rombel}",
        ];
    }
}
