<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::query();

        if ($request->has('tahun') && $request->tahun != '') {
            $query->where('tahun_akademik', $request->tahun);
        }

        $jadwals = $query->get();
        $pilihanTahun = Jadwal::select('tahun_akademik')
                                ->whereNotNull('tahun_akademik') 
                                ->distinct()
                                ->pluck('tahun_akademik');
        return view('jadwalkuliah.index', compact('jadwals', 'pilihanTahun'));
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
            'tahun_akademik' => 'required',
            'kodeMK' => 'required',
            'namaMK' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosenPengajar' => 'required',
            'ruangDanWaktu' => 'required',
            'emailDosen' => 'required|email'
        ]);
        Jadwal::create($request->only('tahun_akademik', 'kodeMK', 'namaMK', 'sks', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams', 'emailDosen'));
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
            'tahun_akademik' => 'required',
            'kodeMK' => 'required',
            'namaMK' => 'required',
            'sks' => 'required|numeric',
            'kelas' => 'required',
            'dosenPengajar' => 'required',
            'ruangDanWaktu' => 'required',
            'emailDosen' => 'required|email'
        ]);
        $jadwal->update($request->only('tahun_akademik', 'kodeMK', 'namaMK', 'sks', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams', 'emailDosen'));
        
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