<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    protected $table = 'pendaftaran';

    protected $fillable = [
        'peserta_ujian_id',
        'nama_orang_tua',
        'alamat',
        'file_akta',
        'file_kk',
    ];

    public function pesertaUjian()
    {
        return $this->belongsTo(PesertaUjian::class, 'peserta_ujian_id');
    }
}
