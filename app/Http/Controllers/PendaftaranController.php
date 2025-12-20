<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Registration;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        $exists = Pendaftaran::where('siswa_id', session('siswa_id'))->exists();

        if ($exists) {
            return redirect()->route('siswa.hasil')
                ->with('error', 'Anda sudah melakukan pendaftaran.');
        }

        return view('siswa.pendaftaran');
    }

    public function store(Request $request)
    {
        $siswaId = session('siswa_id');

        if (Pendaftaran::where('siswa_id', $siswaId)->exists()) {
            return redirect()->route('siswa.hasil');
        }

        $data = $request->validate([
            'nama_orang_tua' => 'required|string|max:100',
            'alamat' => 'required|string',
            'file_akta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data['siswa_id'] = $siswaId;
        $data['file_akta'] = $request->file('file_akta')->store('pendaftaran/akta', 'public');
        $data['file_kk'] = $request->file('file_kk')->store('pendaftaran/kk', 'public');

        Pendaftaran::create($data);

        session()->forget(['siswa_id', 'nama_siswa']);

        return redirect()->route('siswa.login')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
