<?php

namespace App\Http\Controllers;

use App\Models\Jadwal;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jadwals = Jadwal::all();
        return view('jadwalkuliah.index', compact('jadwals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jadwalkuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     */
    public function show(Jadwal $jadwal)
    {
        return view('jadwalkuliah.show', compact('jadwal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jadwal $jadwal)
    {
        return view('jadwalkuliah.edit', compact('jadwal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jadwal $jadwal)
    {
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jadwal $jadwal)
    {
        $jadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'Data Jadwal berhasil dihapus.');
    }
}