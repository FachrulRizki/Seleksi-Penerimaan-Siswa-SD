<?php

namespace App\Http\Controllers;

use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GuruKelasController extends Controller
{
    private function allowedKelasIds(int $guruId)
    {
        $fromJadwal = JadwalPelajaran::where('guru_id', $guruId)->pluck('kelas_id');
        $fromWali   = Kelas::where('wali_guru_id', $guruId)->pluck('id');

        return $fromJadwal->merge($fromWali)->unique()->values();
    }

    public function index()
    {
        $guruId = Auth::guard('guru')->id();
        $kelasIds = $this->allowedKelasIds($guruId);

        $kelas = Kelas::withCount('siswa')
            ->whereIn('id', $kelasIds)
            ->orderBy('nama')
            ->get();

        return view('guru.kelas_index', compact('kelas'));
    }

    public function show(Request $request, $kelas)
    {
        $guruId = Auth::guard('guru')->id();
        $kelasIds = $this->allowedKelasIds($guruId);

        abort_unless($kelasIds->contains((int)$kelas), 403);

        $kelas = Kelas::with('waliGuru')->findOrFail($kelas);

        $siswa = Siswa::where('kelas_id', $kelas->id);

        if ($request->filled('search')) {
            $s = $request->search;
            $siswa->where(function ($qq) use ($s) {
                $qq->where('nama', 'like', "%{$s}%")
                   ->orWhere('nis', 'like', "%{$s}%")
                   ->orWhere('nisn', 'like', "%{$s}%");
            });
        }

        $siswa = $siswa->latest()->paginate(10)->appends($request->query());

        return view('guru.kelas_show', compact('kelas','siswa'));
    }
}
