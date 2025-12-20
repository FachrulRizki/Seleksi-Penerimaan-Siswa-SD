<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use Illuminate\Http\Request;

class HasilUjianController extends Controller
{
    public function index()
    {
        $siswaId = session('siswa_id');

        $hasil = HasilUjian::where('siswa_id', $siswaId)->first();

        if (!$hasil) {
            return redirect()->route('siswa.ujian')->with('error', 'Silakan selesaikan ujian terlebih dahulu.');
        }

        return view('siswa.hasil', compact('hasil'));
    }
}
