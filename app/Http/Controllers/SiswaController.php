<?php

namespace App\Http\Controllers;

use App\Exports\HasilUjianExport;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

class SiswaController extends Controller
{
    public function index()
    {
        $search = request('search');

        $siswa = Siswa::query();

        if ($search) {
            $siswa->where('nama_lengkap', 'like', "%{$search}%");
        }

        $siswa = $siswa->latest()->paginate(10);

        return view('admin.siswa.index', compact('siswa'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
        ]);

        $data['nomor_ujian'] = $this->generateNomorUjian();

        Siswa::create($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    public function edit(Siswa $siswa)
    {
        return view('admin.siswa.edit', compact('siswa'));
    }

    public function update(Request $request, Siswa $siswa)
    {
        $data = $request->validate([
            'nama_lengkap' => 'required|string|max:100',
        ]);

        $siswa->update($data);

        return redirect()
            ->route('admin.siswa.index')
            ->with('success', 'Data siswa berhasil diperbarui.');
    }

    public function destroy(Siswa $siswa)
    {
        $siswa->delete();

        return back()->with('success', 'Data siswa dihapus.');
    }

    public function show(Siswa $siswa)
    {
        $siswa->load([
            'hasilUjian',
            'pendaftaran',
            'jawaban.soal',
            'jawaban.opsiJawaban'
        ]);

        return view('admin.siswa.show', compact('siswa'));
    }

    private function generateNomorUjian(): string
    {
        do {
            $kode = 'SD-' . now()->format('Y') . '-' . strtoupper(Str::random(6));
        } while (Siswa::where('nomor_ujian', $kode)->exists());

        return $kode;
    }

    public function export()
    {
        return Excel::download(new HasilUjianExport, 'hasil_ujian_siswa.xlsx');
    }
}
