<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kelas extends Model
{
    use HasFactory;
    protected $table = 'kelas';

    protected $fillable = ['nama_kelas'];

    // 1 Kelas punya banyak Siswa (1 : N)
    public function siswas(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_kelas');
    }
}
