<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';

    protected $fillable = [
        'nama',
        'nis',
        'nisn',
        'jenis_kelamin',
        'tanggal_lahir',
        'alamat',
        'kelas_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
