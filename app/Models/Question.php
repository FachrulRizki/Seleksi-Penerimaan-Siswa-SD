<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'gambar_soal',
        'a',
        'b',
        'c',
        'd',
        'jawaban_benar'
    ];
}
