<?php

namespace App\Http\Controllers;

use App\Models\Kehadiran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kehadiran = Kehadiran::all();
        return view('kehadirans.index', compact('kehadiran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kehadirans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'semester'=>'required|string|in:Gasal,Genap',
            'namaDosen'=>'required|string|max:255',
            'namaMahasiswa'=>'required|string|max:255',
            'kelas'=>'required|string|max:10',
            'jumlahPertemuan'=>'required|integer|min:1',
            'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
        ]);

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        Kehadiran::create($request->only('kodeMatkul','namaMatkul', 'semester', 'namaDosen', 'namaMahasiswa', 'kelas', 'jumlahPertemuan', 'jumlahKehadiran', 'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran baru dibuat.');
        }

    /**
     * Display the specified resource.
     */
    public function show(Kehadiran $kehadiran)
    {
        return view('kehadirans.show', compact('kehadiran'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kehadiran $kehadiran)
    {
        return view('kehadirans.edit', compact('kehadiran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kehadiran $kehadiran)
    {
        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'semester'=>'required|string|in:gasal,genap',
            'namaDosen'=>'required|string|max:255',
            'namaMahasiswa'=>'required|string|max:255',
            'kelas'=>'required|string|max:10',
            'jumlahPertemuan'=>'required|integer|min:1',
            'jumlahKehadiran'=>'required|integer|min:0|lte:jumlahPertemuan',
        ]);

        $request['persentase'] = ($request->jumlahKehadiran / $request->jumlahPertemuan) * 100;

        $kehadiran->update($request->only('kodeMatkul','namaMatkul', 'semester', 'namaDosen', 'namaMahasiswa', 'kelas', 'jumlahPertemuan', 'jumlahKehadiran', 'persentase'));

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return redirect()->route('kehadiran.index')->with('success', 'Data kehadiran dihapus.');
    }
}
