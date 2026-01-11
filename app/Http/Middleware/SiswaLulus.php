<?php

namespace App\Http\Middleware;

use App\Models\PesertaUjian;
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
        $pesertaId = session('peserta_ujian_id');

        if (!$pesertaId) {
            return redirect()->route('siswa.login');
        }

        $peserta = PesertaUjian::find($pesertaId);

        if (!$peserta || !$peserta->isLulus()) {
            return redirect()->route('siswa.hasil')->with('error', 'Anda tidak memenuhi syarat pendaftaran.');
        }
        
        return $next($request);
    }
}
