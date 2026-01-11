<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index(Request $request)
    {
        $q = Kelas::with('waliGuru');

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where('nama', 'like', "%{$s}%")
              ->orWhere('tahun_ajaran', 'like', "%{$s}%");
        }

        $kelas = $q->latest()->paginate(10)->appends($request->query());

        return view('admin.kelas.index', compact('kelas'));
    }

    public function create()
    {
        $gurus = Guru::where('is_active', true)->orderBy('nama')->get();
        return view('admin.kelas.create', compact('gurus'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:20',
            'tahun_ajaran' => 'nullable|string|max:20',
            'wali_guru_id' => 'nullable|exists:guru,id',
        ]);

        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kelas = Kelas::findOrFail($id);
        $gurus = Guru::where('is_active', true)->orderBy('nama')->get();
        return view('admin.kelas.edit', compact('kelas', 'gurus'));
    }

    public function update(Request $request, $id)
    {
        $kelas = Kelas::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:20',
            'tahun_ajaran' => 'nullable|string|max:20',
            'wali_guru_id' => 'nullable|exists:guru,id',
        ]);

        $kelas->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();

        return redirect()->route('admin.kelas.index')->with('success', 'Kelas berhasil dihapus.');
    }
}
