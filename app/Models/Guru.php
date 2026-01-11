<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Guru extends Authenticatable
{
    protected $table = 'guru';

    protected $fillable = [
        'nama','username','password','nip','no_hp','is_active'
    ];

    protected $hidden = ['password'];

    public function jadwal()
    {
        return $this->hasMany(JadwalPelajaran::class, 'guru_id');
    }

    public function waliKelas()
    {
        return $this->hasMany(Kelas::class, 'wali_guru_id');
    }
}
