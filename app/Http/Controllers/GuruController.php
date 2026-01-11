<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class GuruController extends Controller
{
    public function index(Request $request)
    {
        $q = Guru::query();

        if ($request->filled('search')) {
            $s = $request->search;
            $q->where(function ($qq) use ($s) {
                $qq->where('nama', 'like', "%{$s}%")
                   ->orWhere('username', 'like', "%{$s}%")
                   ->orWhere('nip', 'like', "%{$s}%");
            });
        }

        $gurus = $q->latest()->paginate(10)->appends($request->query());

        return view('admin.guru.index', compact('gurus'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:guru,username',
            'password' => 'required|string|min:8',
            'nip' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        $data['password'] = Hash::make($data['password']);
        $data['is_active'] = (bool)($data['is_active'] ?? true);

        Guru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil ditambahkan.');
    }

    public function edit(Guru $guru)
    {
        return view('admin.guru.edit', compact('guru'));
    }

    public function update(Request $request, Guru $guru)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:guru,username,' . $guru->id,
            'password' => 'nullable|string|min:8',
            'nip' => 'nullable|string|max:50',
            'no_hp' => 'nullable|string|max:30',
            'is_active' => 'nullable|boolean',
        ]);

        // password optional saat update
        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $data['is_active'] = (bool)($data['is_active'] ?? false);

        $guru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil diperbarui.');
    }

    public function destroy(Guru $guru)
    {
        $guru->delete();
        return redirect()->route('admin.guru.index')->with('success', 'Guru berhasil dihapus.');
    }
}
