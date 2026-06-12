<?php

namespace App\Http\Controllers;

use App\Models\historiNilai;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriNilaiController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $akses = historiNilai::with(['mahasiswa','dosen']);

        if ($user->isMahasiswa()) {
            $akses->where('nim', $user->id);
        } elseif ($user->isDosen()) {
            $akses->where('namaDosen', $user->id);
        }

        $historiNilai = $akses->get();
        return view('historiNilais.index', compact('historiNilai'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data histori nilai.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        return view('historiNilais.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|string|min:1',
            'tahunAkademik'=>'required|integer|min:19591',
            'kode'=>'required|string|min:1',
            'mataKuliah'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
            'nilai'=>'required|string|in:A,A-,B+,B,B-,C+,C,D,E,F',
            'bobot'=>'required|integer|max:4',
        ]);
        historiNilai::create($request->only(
            'nim',
            'tahunAkademik',
            'kode',
            'mataKuliah',
            'sks',
            'nilai',
            'bobot'));
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai baru dibuat.');
    }

    public function show(historiNilai $historiNilai)
    {
        return view('historiNilais.show', compact('historiNilai'));
    }

    public function edit(historiNilai $historiNilai)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah data histori nilai.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        return view('historiNilais.edit', compact('historiNilai','mahasiswas', 'dosens'));
    }

    public function update(Request $request, historiNilai $historiNilai)
    {
        $request->validate([
            'nim'=>'required|string|min:1',
            'tahunAkademik'=>'required|integer|min:19591',
            'kode'=>'required|string|min:1',
            'mataKuliah'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
            'nilai'=>'required|string|in:A,A-,B+,B,B-,C+,C,D,E,F',
            'bobot'=>'required|integer|max:4',
        ]);
        historiNilai::update($request->only(
            'nim',
            'tahunAkademik',
            'kode',
            'mataKuliah',
            'sks',
            'nilai',
            'bobot'));
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai diperbarui.');
    }

    public function destroy(historiNilai $historiNilai)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus data histori nilai.');
        }
        $historiNilai->delete();
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai dihapus.');
    }
}
