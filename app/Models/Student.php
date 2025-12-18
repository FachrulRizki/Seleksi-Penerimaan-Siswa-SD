<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'nama',
        'no_ujian',
        'nilai',
        'status_lulus',
        'sudah_ujian'
    ];
}
