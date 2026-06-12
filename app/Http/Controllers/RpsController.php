<?php

namespace App\Http\Controllers;
use App\Models\Rps;
use Illuminate\Http\Request;

class RpsController extends Controller
{

    public function index()
    {
        $semua_rps = Rps::all();
        return view('rps.index', compact('semua_rps'));
    }

    public function create()
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menambahkan RPS.');
        }
        
        return view('rps.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menambahkan RPS.');
        }
        
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|numeric',
            'file_rps' => 'required|url' 
        ]);
        
        Rps::create($request->only('kode_mk', 'nama_mk', 'sks', 'file_rps'));
        
        return redirect()->route('rps.index')->with('success', 'Tautan RPS berhasil ditambahkan.');
    }

    public function show($id)
    {
        $rps = Rps::findOrFail($id);
        return view('rps.show', compact('rps'));
    }

    public function edit($id)
    {
        $user = auth()->user();
        
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa mengedit RPS.');
        }
        $rps = Rps::findOrFail($id);
        return view('rps.edit', compact('rps'));
    }

    public function update(Request $request, $id)
    {
        $user = auth()->user();
        
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa mengedit RPS.');
        }
        
        $request->validate([
            'kode_mk' => 'required',
            'nama_mk' => 'required',
            'sks' => 'required|numeric',
            'file_rps' => 'required|url'
        ]);
        $rps = Rps::findOrFail($id);
        $rps->update($request->only('kode_mk', 'nama_mk', 'sks', 'file_rps'));
        
        return redirect()->route('rps.index')->with('success', 'Data RPS berhasil diperbarui.');
    }

    public function destroy(Rps $id)
    {
        $user = auth()->user();
        
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menghapus RPS.');
        }
        $rps = Rps::findOrFail($id);
        $rps->delete();
        return redirect()->route('rps.index')->with('success', 'Data RPS berhasil dihapus.');
    }
}
