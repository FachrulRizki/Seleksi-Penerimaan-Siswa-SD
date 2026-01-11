<?php

namespace App\Http\Controllers;

use App\Models\Mapel;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    public function index(Request $request)
    {
        $q = Mapel::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where('nama', 'like', "%{$s}%");
        }

        $mapel = $q->orderBy('nama')->paginate(10)->appends($request->query());

        return view('admin.mapel.index', compact('mapel'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:mapel,nama',
        ]);

        Mapel::create($data);

        return redirect()->route('admin.mapel.index')->with('success', 'Mapel berhasil ditambahkan.');
    }

    public function update(Request $request, Mapel $mapel)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100|unique:mapel,nama,' . $mapel->id,
        ]);

        $mapel->update($data);

        return redirect()->route('admin.mapel.index')->with('success', 'Mapel berhasil diperbarui.');
    }

    public function destroy(Mapel $mapel)
    {
        $mapel->delete();
        return redirect()->route('admin.mapel.index')->with('success', 'Mapel berhasil dihapus.');
    }
}
