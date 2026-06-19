<?php

namespace App\Http\Controllers\Akademik;

use App\Models\Jadwal;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index(Request $request)
    {
        $query = Jadwal::with(['mataKuliah', 'dosen']);

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

        $dosens = Pengguna::where('role', 'dosen')->get();
        $matkuls = MataKuliah::all();
        
        return view('jadwalkuliah.create', compact('dosens', 'matkuls'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa menambahkan jadwal.');
        }
        $request->validate([
            'tahun_akademik' => 'required',
            'matkul'=>'required|exists:mata_kuliahs,id',
            'kelas' => 'required',
            'dosenPengajar' => 'required|exists:users,id',
            'ruangDanWaktu' => 'required|string',
            'kodeMSteams' => 'string'

        ]);
        Jadwal::create($request->only('tahun_akademik', 'matkul', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams'));
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

        $dosens = Pengguna::where('role', 'dosen')->get();
        $matkuls = MataKuliah::all();
        
        return view('jadwalkuliah.edit', compact('jadwal', 'dosens', 'matkuls'));    }

    public function update(Request $request, Jadwal $jadwal)
    {
        $user = auth()->user();
        if ($user->isMahasiswa()) {
            abort(403, 'Akses Ditolak! Mahasiswa tidak bisa mengedit jadwal.');
        }
        $request->validate([
            'tahun_akademik' => 'required',
            'matkul'=>'required|exists:mata_kuliahs,id',
            'kelas' => 'required',
            'dosenPengajar' => 'required|exists:users,id',
            'ruangDanWaktu' => 'required|string',
            'kodeMSteams' => 'string'
        ]);
        $jadwal->update($request->only('tahun_akademik', 'matkul', 'kelas', 'dosenPengajar', 'ruangDanWaktu', 'kodeMSteams'));
        
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