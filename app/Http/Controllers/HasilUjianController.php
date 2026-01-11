<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use Illuminate\Http\Request;

class HasilUjianController extends Controller
{
    public function index()
    {
        $pesertaId = session('peserta_ujian_id');

        $hasil = HasilUjian::where('peserta_ujian_id', $pesertaId)->first();

        if (!$hasil) {
            return redirect()->route('peserta.ujian')->with('error', 'Silakan selesaikan ujian terlebih dahulu.');
        }

        return view('peserta.hasil', compact('hasil'));
    }
}
