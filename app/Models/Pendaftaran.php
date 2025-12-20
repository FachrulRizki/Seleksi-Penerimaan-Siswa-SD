<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'siswa_id',
        'nama_orang_tua',
        'alamat',
        'file_akta',
        'file_kk',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
