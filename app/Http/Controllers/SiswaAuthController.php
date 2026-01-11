<?php

namespace App\Http\Controllers;

use App\Models\PesertaUjian;
use Illuminate\Http\Request;

class SiswaAuthController extends Controller
{
    public function index()
    {
        if (session()->has('peserta_ujian_id')) {
            return redirect()->route('peserta.ujian');
        }

        return view('peserta.login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'nomor_ujian' => 'required|string',
        ]);

        $peserta = PesertaUjian::where('nomor_ujian', $data['nomor_ujian'])
            ->where('nama_lengkap', $data['nama_lengkap'])
            ->whereDate('tanggal_lahir', $data['tanggal_lahir'])
            ->first();

        if (!$peserta) {
            return back()
                ->withInput()
                ->with('error', 'Nama / tanggal lahir / nomor ujian tidak sesuai.');
        }

        session([
            'peserta_ujian_id' => $peserta->id,
            'nama_peserta' => $peserta->nama_lengkap,
        ]);

        return redirect()->route('peserta.ujian');
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['peserta_ujian_id', 'nama_peserta']);

        return redirect()->route('peserta.login');
    }
}
