<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KartuPelajar extends Model
{
    use HasFactory;
    protected $fillable = ['nomor_kartu', 'id_siswa'];

    // 1 Kartu Pelajar milik 1 Siswa (1 : 1)
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
}
