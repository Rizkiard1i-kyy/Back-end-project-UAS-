<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        $kehadiran = Kehadiran::all();
        return view('kehadirans.index', compact('kehadiran'));
    }

    public function create()
    {
        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();
        return view('kehadirans.create', compact('mahasiswas', 'dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'semester'=>'required|string|in:Gasal,Genap',
            'namaDosen'=>'required|exists:users,id',
            'nim'=>'required|exists:users,id',
            'kelas'=>'required|string|max:10',
            'jumlahPertemuan'=>'required|integer|min:1',
            'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
        ]);

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        Kehadiran::create($request->only('kodeMatkul','namaMatkul', 'semester', 'namaDosen', 'nim', 'kelas', 'jumlahPertemuan', 'jumlahKehadiran', 'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran baru dibuat.');
    }

    public function show(Kehadiran $kehadiran)
    {
        return view('kehadirans.show', compact('kehadiran'));
    }

    public function edit(Kehadiran $kehadiran)
    {
        $mahasiswas = Pengguna::where('role', 'mahasiswa')->get();
        $dosens = Pengguna::where('role', 'dosen')->get();    
        return view('kehadirans.edit', compact('kehadiran', 'mahasiswas', 'dosens'));
    }

    public function update(Request $request, Kehadiran $kehadiran)
    {
        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'semester'=>'required|string|in:Gasal,Genap',
            'namaDosen'=>'required|exists:users,id',
            'nim'=>'required|exists:users,id',
            'kelas'=>'required|string|max:10',
            'jumlahPertemuan'=>'required|integer|min:1',
            'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
        ]);

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        $kehadiran->update($request->only('kodeMatkul','namaMatkul', 'semester', 'namaDosen', 'nim', 'kelas', 'jumlahPertemuan', 'jumlahKehadiran', 'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran diperbarui.');
    }

    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran dihapus.');
    }
}