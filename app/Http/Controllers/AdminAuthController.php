<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    public function login(Request $r)
    {
        $a = Admin::where('email', $r->email)->first();

        if (!$a || !Hash::check($r->password, $a->password)) {
            return back()->with('error', 'Login gagal');
        }

        session(['admin_id' => $a->id]);
        return redirect('/admin/dashboard');
    }
}
