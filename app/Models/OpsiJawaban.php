<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpsiJawaban extends Model
{
    protected $table = 'opsi_jawaban';

    protected $fillable = [
        'soal_id',
        'teks_opsi',
        'is_benar',
    ];

    protected $casts = [
        'is_benar' => 'boolean',
    ];

    public function soal()
    {
        return $this->belongsTo(Soal::class);
    }
}
