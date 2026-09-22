<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'id_kelas'];

    // N Siswa milik 1 Kelas (N : 1, kebalikan 1 : N)
    public function kelas(): BelongsTo
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }

    // 1 Siswa punya 1 Kartu Pelajar (1 : 1)
    public function kartuPelajar(): HasOne
    {
        return $this->hasOne(KartuPelajar::class, 'id_siswa');
    }
}
