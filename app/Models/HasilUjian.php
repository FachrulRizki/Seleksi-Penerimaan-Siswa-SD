<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HasilUjian extends Model
{
    protected $table = 'hasil_ujian';

    protected $fillable = [
        'siswa_id',
        'jumlah_benar',
        'lulus',
    ];

    protected $casts = [
        'lulus' => 'boolean',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
