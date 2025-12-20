<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\Pendaftaran;
use App\Models\Siswa;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_siswa' => Siswa::count(),
            'sudah_ujian' => Siswa::whereHas('hasilUjian')->count(),
            'lulus_seleksi' => HasilUjian::where('lulus', true)->count(),
            'sudah_pendaftaran' => Pendaftaran::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
