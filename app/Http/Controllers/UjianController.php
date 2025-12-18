<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Question;
use Illuminate\Http\Request;

class UjianController extends Controller
{

    public function index()
    {
        return view('student.ujian', [
            'soal' => Question::all()
        ]);
    }

    public function submit(Request $r)
    {
        $s = Student::find(session('student_id'));
        $benar = 0;

        foreach ($r->jawaban as $id => $j) {
            if (Question::find($id)->jawaban_benar == $j) {
                $benar++;
            }
        }

        $nilai = ($benar / Question::count()) * 10;

        $s->update([
            'nilai' => $nilai,
            'status_lulus' => $nilai >= 6,
            'sudah_ujian' => true
        ]);

        return $nilai >= 6
            ? redirect('/student/registrasi')
            : back()->with('gagal', 'Tidak Lulus');
    }
}
