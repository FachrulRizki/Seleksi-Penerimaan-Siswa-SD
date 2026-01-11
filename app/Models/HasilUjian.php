<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = 'hasil_ujian';

    protected $fillable = [
        'peserta_ujian_id',
        'jumlah_benar',
        'lulus',
    ];

    protected $casts = [
        'lulus' => 'boolean',
    ];

    public function pesertaUjian()
    {
        return $this->belongsTo(PesertaUjian::class, 'peserta_ujian_id');
    }
}
