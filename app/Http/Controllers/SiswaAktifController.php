<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaAktifController extends Controller
{
    public function index(Request $request)
    {
        $q = Siswa::with('kelas');

        if ($request->filled('kelas_id')) {
            $q->where('kelas_id', $request->kelas_id);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function ($qq) use ($s) {
                $qq->where('nama', 'like', "%{$s}%")
                   ->orWhere('nis', 'like', "%{$s}%")
                   ->orWhere('nisn', 'like', "%{$s}%");
            });
        }

        $siswa = $q->latest()->paginate(10)->appends($request->query());
        $kelas = Kelas::orderBy('nama')->get();

        return view('admin.siswa.index', compact('siswa', 'kelas'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama')->get();
        return view('admin.siswa.create', compact('kelas'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:120',
            'nis' => 'required|string|max:30',
            'nisn' => 'required|string|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        Siswa::create($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        $kelas = Kelas::orderBy('nama')->get();

        return view('admin.siswa.edit', compact('siswa', 'kelas'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:120',
            'nis' => 'required|string|max:30',
            'nisn' => 'required|string|max:30',
            'jenis_kelamin' => 'required|in:L,P',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'nullable|string',
            'kelas_id' => 'nullable|exists:kelas,id',
        ]);

        $siswa->update($data);

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Siswa berhasil dihapus.');
    }
}
