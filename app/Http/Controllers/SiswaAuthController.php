<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Student;
use Illuminate\Http\Request;

class SiswaAuthController extends Controller
{
    public function index()
    {
        if (session()->has('siswa_id')) {
            return redirect()->route('siswa.ujian');
        }

        return view('siswa.login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string',
            'nomor_ujian' => 'required|string',
        ]);

        $siswa = Siswa::where('nomor_ujian', $data['nomor_ujian'])
            ->where('nama_lengkap', $data['nama_lengkap'])
            ->first();

        if (!$siswa) {
            return back()
                ->withInput()
                ->with('error', 'Nama atau nomor ujian tidak sesuai.');
        }

        if ($siswa->sudah_ujian) {
            return back()
                ->with('error', 'Anda sudah menyelesaikan ujian.');
        }

        session([
            'siswa_id' => $siswa->id,
            'nama_siswa' => $siswa->nama_lengkap,
        ]);

        return redirect()->route('siswa.ujian');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['siswa_id', 'nama_siswa']);

        return redirect()->route('siswa.login');
    }
}
