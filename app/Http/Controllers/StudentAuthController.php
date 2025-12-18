<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentAuthController extends Controller
{
    public function login(Request $r)
    {
        $s = Student::where('nama', $r->nama)
            ->where('no_ujian', $r->no_ujian)->first();

        if (!$s) return back()->with('error', 'Login gagal');

        session(['student_id' => $s->id]);
        return redirect('/student/ujian');
    }
}
