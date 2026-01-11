<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruJadwalController extends Controller
{
    public function index()
    {
        $guruId = Auth::guard('guru')->id();

        $items = JadwalPelajaran::with(['kelas','mapel'])
            ->where('guru_id', $guruId)
            ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->get()
            ->groupBy('hari');

        return view('guru.jadwal', compact('items'));
    }
}
