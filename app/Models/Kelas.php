<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $table = 'kelas';

    protected $fillable = [
        'nama',
        'tahun_ajaran',
        'wali_guru_id',
    ];

    public function waliGuru()
    {
        return $this->belongsTo(Guru::class, 'wali_guru_id');
    }

    public function siswa()
    {
        return $this->hasMany(Siswa::class, 'kelas_id');
    }

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'kelas_id');
    }
}
