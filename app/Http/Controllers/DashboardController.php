<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\JadwalPelajaran;
use App\Models\Pendaftaran;
use App\Models\PesertaUjian;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::guard('guru')->check()) {
            $guru = Auth::guard('guru')->user();

            $hari = now()->locale('id')->translatedFormat('l'); 

            $mapHari = [
                'Monday'=>'Senin','Tuesday'=>'Selasa','Wednesday'=>'Rabu','Thursday'=>'Kamis','Friday'=>'Jumat','Saturday'=>'Sabtu','Sunday'=>'Minggu',
            ];
            $hari = $mapHari[$hari] ?? $hari;

            $jadwalHariIni = JadwalPelajaran::with(['kelas','mapel'])
                ->where('guru_id', $guru->id)
                ->where('hari', $hari)
                ->orderBy('jam_mulai')
                ->get();

            return view('guru.dashboard', compact('guru','hari','jadwalHariIni'));
        }

        $stats = [
            'total_siswa' => PesertaUjian::count(),
            'sudah_ujian' => PesertaUjian::whereHas('hasilUjian')->count(),
            'lulus_seleksi' => HasilUjian::where('lulus', true)->count(),
            'sudah_pendaftaran' => Pendaftaran::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
