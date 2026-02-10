<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use Illuminate\Support\Str;
use App\Models\PesertaUjian;
use Illuminate\Http\Request;
use App\Exports\HasilUjianExport;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $peserta = PesertaUjian::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $peserta->where(function ($qq) use ($search) {
                $qq->where('nama_lengkap', 'like', "%{$search}%")
                ->orWhere('nomor_ujian', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status_ujian') && $request->status_ujian !== 'all') {
            if ($request->status_ujian === 'sudah') {
                $peserta->whereHas('hasilUjian');
            } elseif ($request->status_ujian === 'belum') {
                $peserta->whereDoesntHave('hasilUjian');
            }
        }

        if ($request->filled('status_lulus') && $request->status_lulus !== 'all') {
            if ($request->status_lulus === 'lulus') {
                $peserta->whereHas('hasilUjian', fn($hq) => $hq->where('lulus', 1));
            } elseif ($request->status_lulus === 'tidak') {
                $peserta->whereHas('hasilUjian', fn($hq) => $hq->where('lulus', 0));
            }
        }

        $peserta = $peserta->latest()->paginate(10)->appends($request->query());

        return view('admin.peserta.index', compact('peserta'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap'   => 'required|string|max:100',
            'tanggal_lahir'  => 'required|date',
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

        PesertaUjian::create($data);

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil ditambahkan.');
    }

    public function edit(PesertaUjian $pesertum)
    {
        return view('admin.peserta.edit', ['peserta' => $pesertum]);
    }

    public function update(Request $request, PesertaUjian $pesertum)
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

        $pesertum->update($data);

        return redirect()
            ->route('admin.peserta.index')
            ->with('success', 'Data peserta berhasil diperbarui.');
    }

    public function destroy(PesertaUjian $pesertum)
    {
        $pesertum->delete();

        return back()->with('success', 'Data peserta berhasil dihapus.');
    }

    public function show(PesertaUjian $pesertum)
    {
        $pesertum->load([
            'hasilUjian',
            'pendaftaran',
            'jawaban.soal',
            'jawaban.opsiJawaban'
        ]);

        return view('admin.peserta.show', ['peserta' => $pesertum]);
    }

    private function generateNomorUjian(): string
    {
        do {
            $kode = 'SD-' . now()->format('Y') . '-' . strtoupper(Str::random(6));
        } while (PesertaUjian::where('nomor_ujian', $kode)->exists());

        return $kode;
    }

    public function export()
    {
        return Excel::download(new HasilUjianExport, 'hasil_ujian_peserta.xlsx');
    }
}
