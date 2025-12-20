<?php

namespace App\Http\Middleware;

use App\Models\Siswa;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SiswaLulus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $siswaId = session('siswa_id');

        if (!$siswaId) {
            return redirect()->route('login.ujian');
        }

        $siswa = Siswa::find($siswaId);

        if (!$siswa || !$siswa->isLulus()) {
            return redirect()->route('siswa.hasil')->with('error', 'Anda tidak memenuhi syarat pendaftaran.');
        }
        
        return $next($request);
    }
}
