<?php

namespace App\Http\Controllers;

use App\Models\HasilUjian;
use App\Models\JawabanSiswa;
use App\Models\OpsiJawaban;
use App\Models\Soal;
use Illuminate\Http\Request;

class UjianController extends Controller
{
    public function start()
    {
        $pesertaId = session('peserta_ujian_id');

        if (HasilUjian::where('peserta_ujian_id', $pesertaId)->exists()) {
            return redirect()->route('peserta.hasil');
        }

        return redirect()->route('peserta.ujian.show', 1);
    }

    public function show($nomor)
    {
        $pesertaId = session('peserta_ujian_id');

        $urutanSoal = Soal::orderBy('created_at')->pluck('id');

        $totalSoal = $urutanSoal->count();

        if ($nomor < 1 || $nomor > $totalSoal) {
            abort(404);
        }

        $soalId = $urutanSoal[$nomor - 1];

        $soal = Soal::with('opsiJawaban')->findOrFail($soalId);

        $jawaban = JawabanSiswa::where([
            'peserta_ujian_id' => $pesertaId,
            'soal_id'  => $soal->id
        ])->first();

        return view('peserta.ujian', compact(
            'soal',
            'nomor',
            'totalSoal',
            'jawaban'
        ));
    }

    public function submit(Request $request)
    {
        $data = $request->validate([
            'soal_id' => 'required|uuid|exists:soal,id',
            'opsi_jawaban_id' => 'required|exists:opsi_jawaban,id',
            'nomor' => 'required|integer'
        ]);

        $pesertaId = session('peserta_ujian_id');

        $opsi = OpsiJawaban::findOrFail($data['opsi_jawaban_id']);

        JawabanSiswa::updateOrCreate(
            [
                'peserta_ujian_id' => $pesertaId,
                'soal_id'  => $data['soal_id']
            ],
            [
                'opsi_jawaban_id' => $opsi->id,
                'benar' => $opsi->is_benar
            ]
        );

        $totalSoal = Soal::count();

        if ($data['nomor'] > $totalSoal) {
            return $this->finish($request);
        }

        return redirect()->route('peserta.ujian.show', $data['nomor']);
    }

    public function finish()
    {
        $pesertaId = session('peserta_ujian_id');

        if (HasilUjian::where('peserta_ujian_id', $pesertaId)->exists()) {
            return redirect()->route('peserta.hasil');
        }

        $jumlahBenar = JawabanSiswa::where('peserta_ujian_id', $pesertaId)
            ->where('benar', true)
            ->count();

        HasilUjian::create([
            'peserta_ujian_id' => $pesertaId,
            'jumlah_benar' => $jumlahBenar,
            'lulus' => $jumlahBenar >= 7
        ]);

        return redirect()->route('peserta.hasil');
    }
}
