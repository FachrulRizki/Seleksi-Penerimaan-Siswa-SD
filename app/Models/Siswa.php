<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    
    protected $fillable = [
        'nama_lengkap',
        'nomor_ujian',
    ];

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class);
    }

    public function hasilUjian()
    {
        return $this->hasOne(HasilUjian::class);
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class);
    }

    public function isLulus(): bool
    {
        return $this->hasilUjian()->exists() && $this->hasilUjian->lulus;
    }

}
