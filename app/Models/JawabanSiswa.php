<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JawabanSiswa extends Model
{
    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'siswa_id',
        'soal_id',
        'opsi_jawaban_id',
        'benar'
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }

    public function opsiJawaban()
    {
        return $this->belongsTo(OpsiJawaban::class);
    }
}
