<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = Pengguna::query();

        if ($request->has('role')) {
            $query->where('role', $request->role);
        }

        $pengguna = $query->select(
            'id',
            'nama',
            'email',
            'nim',
            'role',
            'created_at'
        )->get();

        return view('pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        return view('pengguna.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'=> 'required|string|max:255',
            'email'=> 'required|email|unique:users,email',
            'nim'=> 'nullable|string|max:20|unique:users,nim',
            'password'=> 'required|string|min:8|confirmed',
            'role'=> 'required|in:mahasiswa,dosen,admin',
        ]);

        Pengguna::create([
            'nama'=> $request->nama,
            'email'=> $request->email,
            'nim'=> $request->nim,
            'password'=> Hash::make($request->password),
            'role'=> $request->role,
        ]);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function show(Request $request, Pengguna $pengguna)
    {
        $me = $request->user();

        $me = $request->user();

        if (!$me->isAdmin() && $me->id !== $pengguna->id) {
            abort(403, 'Akses ditolak.');
        }
        return view('pengguna.show', compact('pengguna'));
    }

    public function edit(Pengguna $pengguna)
    {
        return view('pengguna.edit', compact('pengguna'));
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        $me = $request->user();

        if (!$me->isAdmin() && $me->id !== $pengguna->id) {
            abort(403, 'Akses ditolak.');
        }

        $rules = [
            'nama'=> 'sometimes|string|max:255',
            'nim'=> 'sometimes|string|max:20|unique:users,nim,' . $pengguna->id,
            'email'=> 'sometimes|email|unique:users,email,' . $pengguna->id,
            'password'=> 'nullable|string|min:8|confirmed',
        ];
        
        if ($me->isAdmin()) {
            $rules['role'] = 'sometimes|in:mahasiswa,dosen,admin';
        }

        $request->validate($rules);

        $data = $request->only(['nama', 'nim', 'email']);

        if ($me->isAdmin() && $request->has('role')) {
            $data['role'] = $request->role;
        }

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $pengguna->update($data);

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil diupdate.');
    }

    public function destroy(Pengguna $pengguna)
    {
        $pengguna->delete();

        return redirect()->route('pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
