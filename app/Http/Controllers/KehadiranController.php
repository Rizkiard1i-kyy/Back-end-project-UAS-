<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pengguna;
use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $query = Kehadiran::with(['mahasiswa','dosen', 'mataKuliah']);;

        if ($user->isMahasiswa()) {
            $query->where('nim', $user->id);
        } elseif ($user->isDosen()) {
            $query->where('namaDosen', $user->id);
        }

        $kehadiran = $query->get();
        return view('kehadirans.index', compact('kehadiran'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data kehadiran.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $matkuls = MataKuliah::all();

        return view('kehadirans.create', compact('mahasiswas', 'dosens', 'matkuls'));
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data kehadiran.');
        }

        $request->validate([
            'matkul'=>'required|exists:mata_kuliahs,id',
            'semester'=>'required|string|in:Gasal,Genap',
            'namaDosen'=>'required|exists:users,id',
            'nim'=>'required|exists:users,id',
            'kelas'=>'required|string|max:10',
            'jumlahPertemuan'=>'required|integer|min:1',
            'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
        ]);

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        Kehadiran::create($request->only(
            'matkul', 
            'semester', 
            'namaDosen', 
            'nim', 
            'kelas', 
            'jumlahPertemuan', 
            'jumlahKehadiran', 
            'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran baru dibuat.');
    }

    public function show(Kehadiran $kehadiran)
    {
        $user = auth()->user();
    
        if ($user->isMahasiswa() && (int)$kehadiran->nim !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data kehadiran mahasiswa lain.');
        }

        if ($user->isDosen() && (int)$kehadiran->namaDosen !== $user->id) {
            abort(403, 'Anda tidak bisa melihat data kehadiran ini.');
        }
        return view('kehadirans.show', compact('kehadiran'));
    }

    public function edit(Kehadiran $kehadiran)
    {
        $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && (int)$kehadiran->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data kehadiran ini.');
        }

        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        $matkuls = MataKuliah::all();

        return view('kehadirans.edit', compact('kehadiran', 'mahasiswas', 'dosens', 'matkuls'));
    }

    public function update(Request $request, Kehadiran $kehadiran)
    {
       $user = auth()->user();

        if ($user->isMahasiswa() || $user->isDosen() && (int)$kehadiran->namaDosen !== $user->id ) {
            abort(403, 'Anda tidak boleh mengubah data kehadiran ini.');
        }

        if ($user->isAdmin()) {
            $request->validate([
                'matkul'=>'required|exists:mata_kuliahs,id',
                'semester'=>'required|string|in:Gasal,Genap',
                'namaDosen'=>'required|exists:users,id',
                'nim'=>'required|exists:users,id',
                'kelas'=>'required|string|max:10',
                'jumlahPertemuan'=>'required|integer|min:1',
                'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
            ]);
        } else {
             $request->validate([
                'jumlahPertemuan'=>'required|integer|min:1',
                'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
            ]);
        }

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        $kehadiran->update($request->only(
            'matkul', 
            'semester', 
            'namaDosen', 
            'nim', 
            'kelas', 
            'jumlahPertemuan', 
            'jumlahKehadiran', 
            'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran diperbarui.');
    }

    public function destroy(Kehadiran $kehadiran)
    {
      if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh menghapus data kehadiran.');
        }

        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran dihapus.');
    }
}