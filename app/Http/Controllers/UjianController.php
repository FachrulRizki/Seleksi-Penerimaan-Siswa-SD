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
        $siswaId = session('siswa_id');

        if (HasilUjian::where('siswa_id', $siswaId)->exists()) {
            return redirect()->route('siswa.hasil');
        }

        return redirect()->route('siswa.ujian.show', 1);
    }

    public function show($nomor)
    {
        $siswaId = session('siswa_id');

        $urutanSoal = Soal::orderBy('created_at')->pluck('id');

        $totalSoal = $urutanSoal->count();

        if ($nomor < 1 || $nomor > $totalSoal) {
            abort(404);
        }

        $soalId = $urutanSoal[$nomor - 1];

        $soal = Soal::with('opsiJawaban')->findOrFail($soalId);

        $jawaban = JawabanSiswa::where([
            'siswa_id' => $siswaId,
            'soal_id'  => $soal->id
        ])->first();

        return view('siswa.ujian', compact(
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

        $siswaId = session('siswa_id');

        $opsi = OpsiJawaban::findOrFail($data['opsi_jawaban_id']);

        JawabanSiswa::updateOrCreate(
            [
                'siswa_id' => $siswaId,
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

        return redirect()->route('siswa.ujian.show', $data['nomor']);
    }

    public function finish()
    {
        $siswaId = session('siswa_id');

        if (HasilUjian::where('siswa_id', $siswaId)->exists()) {
            return redirect()->route('siswa.hasil');
        }

        $jumlahBenar = JawabanSiswa::where('siswa_id', $siswaId)
            ->where('benar', true)
            ->count();

        HasilUjian::create([
            'siswa_id' => $siswaId,
            'jumlah_benar' => $jumlahBenar,
            'lulus' => $jumlahBenar >= 7
        ]);

        return redirect()->route('siswa.hasil');
    }
}
