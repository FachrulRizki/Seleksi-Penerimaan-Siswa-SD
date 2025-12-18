<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function report()
    {
        return view('admin.report', [
            'data' => Student::with('registration')->get()
        ]);
    }
}
