<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
        return view('admin.soal.index', [
            'soal' => Question::all()
        ]);
    }

    public function create()
    {
        return view('admin.soal.create');
    }

    public function store(Request $r)
    {
        $r->validate([
            'gambar_soal' => 'required|image|mimes:jpg,jpeg,png',
            'a' => 'required',
            'b' => 'required',
            'c' => 'required',
            'd' => 'required',
            'jawaban_benar' => 'required|in:a,b,c,d'
        ]);

        // SIMPAN KE PUBLIC DISK (INI KUNCI)
        $path = $r->file('gambar_soal')->store('soal', 'public');

        Question::create([
            'gambar_soal' => $path,
            'a' => $r->a,
            'b' => $r->b,
            'c' => $r->c,
            'd' => $r->d,
            'jawaban_benar' => $r->jawaban_benar
        ]);

        return redirect('/admin/soal')->with('success', 'Soal berhasil disimpan');
    }
}
