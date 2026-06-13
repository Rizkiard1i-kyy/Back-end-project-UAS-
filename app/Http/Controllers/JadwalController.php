<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('jadwalkuliah.index', compact('jadwals'));
    }

    public function create()
    {
        $user = auth()->user();
        
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menambahkan jadwal.');
        }
        
        return view('jadwalkuliah.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menambahkan jadwal.');
        }
        $request->validate([
            'kodeMK' => 'required',
            'namaMK' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosenPengajar' => 'required',
            'ruangDanWaktu' => 'required',
            'emailDosen' => 'required|email'
        ]);
        Jadwal::create($request->only('kodeMK', 'namaMK', 'sks', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams', 'emailDosen'));
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil ditambahkan.');
    }

    public function show(Jadwal $jadwal)
    {
        return view('jadwalkuliah.show', compact('jadwal'));
    }

    public function edit(Jadwal $jadwal)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa mengedit jadwal.');
        }
        return view('jadwalkuliah.edit', compact('jadwal'));
    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa mengedit jadwal.');
        }
        $request->validate([
            'kodeMK' => 'required',
            'namaMK' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosenPengajar' => 'required',
            'ruangDanWaktu' => 'required',
            'emailDosen' => 'required|email'
        ]);
        $jadwal->update($request->only('kodeMK', 'namaMK', 'sks', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams', 'emailDosen'));
        
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil diperbarui.');
    }

    public function destroy(Jadwal $jadwal)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menghapus jadwal.');
        }
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil dihapus.');
    }
}