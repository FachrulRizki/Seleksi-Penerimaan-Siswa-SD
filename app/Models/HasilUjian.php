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
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $casts = [
        'lulus' => 'boolean',
        'waktu_mulai' => 'datetime',
        'waktu_selesai' => 'datetime',
    ];

    public function pesertaUjian()
    {
        return $this->belongsTo(PesertaUjian::class, 'peserta_ujian_id');
    }
}
