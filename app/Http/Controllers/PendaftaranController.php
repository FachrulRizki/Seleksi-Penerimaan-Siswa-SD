<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function create()
    {
        $exists = Pendaftaran::where('peserta_ujian_id', session('peserta_ujian_id'))->exists();

        if ($exists) {
            return redirect()->route('peserta.hasil')
                ->with('error', 'Anda sudah melakukan pendaftaran.');
        }

        return view('peserta.pendaftaran');
    }

    public function store(Request $request)
    {
        $pesertaId = session('peserta_ujian_id');

        if (Pendaftaran::where('peserta_ujian_id', $pesertaId)->exists()) {
            return redirect()->route('peserta.hasil');
        }

        $data = $request->validate([
            'nama_orang_tua' => 'required|string|max:100',
            'alamat' => 'required|string',
            'file_akta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'file_kk' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $data['peserta_ujian_id'] = $pesertaId;
        $data['file_akta'] = $request->file('file_akta')->store('pendaftaran/akta', 'public');
        $data['file_kk'] = $request->file('file_kk')->store('pendaftaran/kk', 'public');

        Pendaftaran::create($data);

        session()->forget(['peserta_ujian_id', 'nama_peserta']);

        return redirect()->route('peserta.login')->with('success', 'Pendaftaran berhasil dikirim.');
    }
}
