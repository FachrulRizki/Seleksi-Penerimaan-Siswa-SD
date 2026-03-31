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

        // 🔒 Cek kuota
        if (HasilUjian::where('lulus', true)->count() >= 28) {
            return redirect()->route('peserta.hasil')
                ->with('error', 'Kuota 28 peserta sudah terpenuhi');
        }

        // 🔥 Pastikan data ada + waktu mulai tersimpan
        HasilUjian::firstOrCreate(
            ['peserta_ujian_id' => $pesertaId],
            [
                'waktu_mulai' => now(),
                'jumlah_benar' => 0,
                'lulus' => false
            ]
        );

        return redirect()->route('peserta.ujian.show', 1);
    }

    public function show($nomor)
    {
        $pesertaId = session('peserta_ujian_id');

        $hasil = HasilUjian::firstOrCreate(
            ['peserta_ujian_id' => $pesertaId],
            [
                'jumlah_benar' => 0,
                'lulus' => false
            ]
        );

        if (is_null($hasil->waktu_mulai)) {
            $hasil->waktu_mulai = now();
            $hasil->save();
            $hasil->refresh();
        }

        $urutanSoal = Soal::orderBy('created_at')->pluck('id');
        $totalSoal = $urutanSoal->count();

        if ($nomor < 1 || $nomor > $totalSoal) {
            abort(404);
        }

        $soalId = $urutanSoal[$nomor - 1];

        $soal = Soal::with('opsiJawaban')->findOrFail($soalId);

        $jawaban = JawabanSiswa::where([
            'peserta_ujian_id' => $pesertaId,
            'soal_id' => $soal->id
        ])->first();

        return view('peserta.ujian', compact(
            'soal',
            'nomor',
            'totalSoal',
            'jawaban',
            'hasil'
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

        // 🔥 Simpan jawaban
        $opsi = OpsiJawaban::findOrFail($data['opsi_jawaban_id']);

        JawabanSiswa::updateOrCreate(
            [
                'peserta_ujian_id' => $pesertaId,
                'soal_id' => $data['soal_id']
            ],
            [
                'opsi_jawaban_id' => $opsi->id,
                'benar' => $opsi->is_benar
            ]
        );

        $totalSoal = Soal::count();

        // 🔚 Jika selesai semua soal
        if ($data['nomor'] > $totalSoal) {
            return $this->finish();
        }

        // ⏱ Cek waktu habis
        $hasil = HasilUjian::where('peserta_ujian_id', $pesertaId)->first();

        $durasi = 30 * 60; // 30 menit

        if ($hasil && $hasil->waktu_mulai) {
            $elapsed = now()->diffInSeconds($hasil->waktu_mulai);

            if ($elapsed >= $durasi) {
                return $this->finish();
            }
        }

        // 🔒 Cek kuota lagi
        if (HasilUjian::where('lulus', true)->count() >= 28) {
            return redirect()->route('peserta.hasil')
                ->with('error', 'Tes ditutup, kuota sudah penuh');
        }

        return redirect()->route('peserta.ujian.show', $data['nomor']);
    }

    public function finish()
    {
        $pesertaId = session('peserta_ujian_id');

        $hasil = HasilUjian::firstOrCreate(
            ['peserta_ujian_id' => $pesertaId],
            [
                'jumlah_benar' => 0,
                'lulus' => false
            ]
        );

        // 🔒 Jangan hitung ulang kalau sudah selesai
        if ($hasil->waktu_selesai) {
            return redirect()->route('peserta.hasil');
        }

        // ✅ Hitung nilai
        $jumlahBenar = JawabanSiswa::where('peserta_ujian_id', $pesertaId)
            ->where('benar', true)
            ->count();

        $hasil->update([
            'jumlah_benar' => $jumlahBenar,
            'waktu_selesai' => now(),
        ]);

        // 🏆 Ranking TOP 28 (nilai + kecepatan)
        $top28 = HasilUjian::selectRaw("
                *,
                TIMESTAMPDIFF(SECOND, waktu_mulai, waktu_selesai) as durasi
            ")
            ->whereNotNull('waktu_selesai')
            ->orderByDesc('jumlah_benar')
            ->orderBy('durasi')
            ->limit(28)
            ->pluck('id');

        // Reset semua
        HasilUjian::query()->update(['lulus' => false]);

        // Set TOP 28
        HasilUjian::whereIn('id', $top28)->update([
            'lulus' => true
        ]);

        return redirect()->route('peserta.hasil');
    }
}
