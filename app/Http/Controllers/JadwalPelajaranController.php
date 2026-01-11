<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\JadwalPelajaran;
use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;

class JadwalPelajaranController extends Controller
{
    private array $hariOrder = ['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];

    public function index(Request $request)
    {
        $q = JadwalPelajaran::with(['kelas','mapel','guru']);

        if ($request->filled('kelas_id')) $q->where('kelas_id', $request->kelas_id);
        if ($request->filled('guru_id'))  $q->where('guru_id', $request->guru_id);
        if ($request->filled('hari'))     $q->where('hari', $request->hari);

        $jadwal = $q
            ->orderByRaw("FIELD(hari,'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu')")
            ->orderBy('jam_mulai')
            ->paginate(15)
            ->appends($request->query());

        $kelas = Kelas::orderBy('nama')->get();
        $guru = Guru::where('is_active', true)->orderBy('nama')->get();

        return view('admin.jadwal.index', compact('jadwal','kelas','guru'));
    }

    public function create()
    {
        $kelas = Kelas::orderBy('nama')->get();
        $mapel = Mapel::orderBy('nama')->get();
        $guru = Guru::where('is_active', true)->orderBy('nama')->get();
        $hari  = $this->hariOrder;

        return view('admin.jadwal.create', compact('kelas','mapel','guru','hari'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $this->ensureNoConflict($data);

        JadwalPelajaran::create($data);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $kelas = Kelas::orderBy('nama')->get();
        $mapel = Mapel::orderBy('nama')->get();
        $guru = Guru::where('is_active', true)->orderBy('nama')->get();
        $hari  = $this->hariOrder;

        return view('admin.jadwal.edit', compact('jadwal','kelas','mapel','guru','hari'));
    }

    public function update(Request $request, $id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);

        $data = $this->validateData($request);

        $this->ensureNoConflict($data, $jadwal->id);

        $jadwal->update($data);

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $jadwal = JadwalPelajaran::findOrFail($id);
        $jadwal->delete();

        return redirect()->route('admin.jadwal.index')->with('success', 'Jadwal berhasil dihapus.');
    }

    private function validateData(Request $request): array
    {
        $data = $request->validate([
            'kelas_id' => 'required|exists:kelas,id',
            'mapel_id' => 'required|exists:mapel,id',
            'guru_id'  => 'required|exists:guru,id',
            'hari'     => 'required|in:Senin,Selasa,Rabu,Kamis,Jumat,Sabtu',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i',
            'ruang'    => 'nullable|string|max:50',
        ], [
            'kelas_id.required' => 'Kelas wajib dipilih.',
            'mapel_id.required' => 'Mapel wajib dipilih.',
            'guru_id.required'  => 'Guru wajib dipilih.',
            'hari.required'     => 'Hari wajib dipilih.',
        ]);

        // validasi jam
        if ($data['jam_mulai'] >= $data['jam_selesai']) {
            abort(back()->withErrors(['jam_selesai' => 'Jam selesai harus lebih besar dari jam mulai.'])->withInput());
        }

        return $data;
    }

    /**
     * Cek bentrok jadwal:
     * 1) Guru tidak boleh overlap pada hari yang sama
     * 2) Kelas tidak boleh overlap pada hari yang sama
     */
    private function ensureNoConflict(array $data, ?int $ignoreId = null): void
    {
        $base = JadwalPelajaran::query()
            ->where('hari', $data['hari'])
            ->where(function ($q) use ($data) {
                // overlap condition:
                // new_start < existing_end AND new_end > existing_start
                $q->where('jam_mulai', '<', $data['jam_selesai'])
                  ->where('jam_selesai', '>', $data['jam_mulai']);
            });

        if ($ignoreId) $base->where('id', '!=', $ignoreId);

        // Bentrok guru
        $conflictGuru = (clone $base)->where('guru_id', $data['guru_id'])->exists();
        if ($conflictGuru) {
            abort(back()->withErrors(['guru_id' => 'Jadwal bentrok: guru sudah ada jadwal di jam tersebut.'])->withInput());
        }

        // Bentrok kelas
        $conflictKelas = (clone $base)->where('kelas_id', $data['kelas_id'])->exists();
        if ($conflictKelas) {
            abort(back()->withErrors(['kelas_id' => 'Jadwal bentrok: kelas sudah ada jadwal di jam tersebut.'])->withInput());
        }
    }
}
