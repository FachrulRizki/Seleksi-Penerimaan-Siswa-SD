<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;

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

        // Hitung umur
        $umur = Carbon::parse($data['tanggal_lahir'])->age;

        // Cek jika umur < 7 tahun
        if ($umur < 7) {
            return redirect()
                ->back()
                ->withInput()
                ->withErrors([
                    'tanggal_lahir' => 'Calon siswa harus berusia minimal 7 tahun untuk dapat mendaftar.'
                ]);
        }

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
