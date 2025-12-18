<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class RegistrasiController extends Controller
{
    public function index()
    {
        return view('student.registrasi');
    }

    public function store(Request $r)
    {
        Registration::create([
            'student_id' => session('student_id'),
            'alamat' => $r->alamat,
            'nama_orangtua' => $r->nama_orangtua,
            'akta' => $r->file('akta')->store('berkas'),
            'kk' => $r->file('kk')->store('berkas'),
        ]);
        return redirect('/selesai');
    }
}
