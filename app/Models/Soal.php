<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasUuids;
    
    protected $table = 'soal';

    protected $fillable = [
        'gambar_soal',
    ];

    public function opsiJawaban()
    {
        return $this->hasMany(OpsiJawaban::class);
    }
}
