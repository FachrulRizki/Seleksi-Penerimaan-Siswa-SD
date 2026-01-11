<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesertaUjian extends Model
{
    protected $table = 'peserta_ujian';
    
    protected $fillable = [
        'nama_lengkap',
        'tanggal_lahir',
        'nomor_ujian',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function jawaban()
    {
        return $this->hasMany(JawabanSiswa::class, 'peserta_ujian_id');
    }

    public function hasilUjian()
    {
        return $this->hasOne(HasilUjian::class, 'peserta_ujian_id');
    }

    public function pendaftaran()
    {
        return $this->hasOne(Pendaftaran::class, 'peserta_ujian_id');
    }

    public function isLulus(): bool
    {
        return $this->hasilUjian()->exists() && $this->hasilUjian->lulus;
    }

}
