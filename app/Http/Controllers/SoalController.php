<?php

namespace App\Http\Controllers;

use App\Models\OpsiJawaban;
use App\Models\Question;
use App\Models\Soal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SoalController extends Controller
{
    public function index()
    {
        $soal = Soal::latest()->paginate(8);
        return view('admin.soal.index', compact('soal'));
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'gambar_soal' => 'required|image|max:2048',
            'opsi' => 'required|array|size:4',
            'opsi.*' => 'required|string',
            'jawaban' => 'required|in:0,1,2,3',
        ]);

        $path = $request->file('gambar_soal')->store('soal', 'public');

        $soal = Soal::create([
            'gambar_soal' => $path,
        ]);

        foreach ($data['opsi'] as $i => $teks) {
            OpsiJawaban::create([
                'soal_id'  => $soal->id,
                'teks_opsi'=> $teks,
                'is_benar' => ($i == $data['jawaban']),
            ]);
        }

        return redirect()
            ->route('admin.soal.index')
            ->with('success', 'Soal berhasil ditambahkan.');
    }

    public function edit(Soal $soal)
    {
        $soal->load('opsiJawaban');
        return view('admin.soal.edit', compact('soal'));
    }

    public function update(Request $request, Soal $soal)
    {
        $data = $request->validate([
            'gambar_soal' => 'nullable|image|max:2048',
            'opsi' => 'required|array|size:4',
            'opsi.*' => 'required|string',
            'jawaban' => 'required|in:0,1,2,3',
        ]);

        if ($request->hasFile('gambar_soal')) {
            Storage::disk('public')->delete($soal->gambar_soal);
            $soal->gambar_soal = $request->file('gambar_soal')->store('soal', 'public');
            $soal->save();
        }

        foreach ($soal->opsiJawaban as $i => $opsi) {
            $opsi->update([
                'teks_opsi' => $data['opsi'][$i],
                'is_benar'  => ($i == $data['jawaban']),
            ]);
        }

        return redirect()
            ->route('admin.soal.index')
            ->with('success', 'Soal berhasil diperbarui.');
    }

    public function destroy(Soal $soal)
    {
        Storage::disk('public')->delete($soal->gambar_soal);
        $soal->delete();

        return back()->with('success', 'Soal berhasil dihapus.');
    }
}
