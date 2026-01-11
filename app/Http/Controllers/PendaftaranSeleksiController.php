<?php

namespace App\Http\Controllers;

use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PendaftaranSeleksiController extends Controller
{
    public function create()
    {
        return view('peserta.daftar');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
            'tanggal_lahir' => 'required|date',
        ]);

        $data['nomor_ujian'] = $this->generateNomorUjian();

        $peserta = PesertaUjian::create($data);

        return redirect()
            ->route('peserta.login')
            ->with('success', 'Pendaftaran berhasil. Nomor ujian Anda: ' . $peserta->nomor_ujian);
    }

    private function generateNomorUjian(): string
    {
        do {
            $kode = 'SD-' . now()->format('Y') . '-' . strtoupper(Str::random(6));
        } while (PesertaUjian::where('nomor_ujian', $kode)->exists());

        return $kode;
    }
}
