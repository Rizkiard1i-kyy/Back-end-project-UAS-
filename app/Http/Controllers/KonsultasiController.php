<?php

namespace App\Http\Controllers;

use App\Models\Konsultasi;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->isAdmin()) {
            $konsultasi = Konsultasi::orderBy('tanggal', 'desc')->get();
        } else {
            $konsultasi = Konsultasi::where('nim', auth()->user()->nim)->orderBy('tanggal', 'desc')->get();
        }
        return view('konsultasi.index', compact('konsultasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('konsultasi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_dosen'=>'required|string|max:255',
            'tanggal'=>'required|date|after_or_equal:today',
            'jam'=>'required|string|max:20',
            'topik'=>'required|string|max:1000',
        ]);

        Konsultasi::create([
            'nim'=>auth()->user()->nim,
            'nama_mahasiswa'=>auth()->user()->nama,
            'nama_dosen'=>$request->nama_dosen,
            'tanggal'=>$request->tanggal,
            'jam'=>$request->jam,
            'topik'=>$request->topik,
            'status'=>'menunggu',
        ]);

        return redirect()->route('konsultasi.index')->with('success', 'Permintaan konsultasi berhasil dikirim.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Konsultasi $konsultasi)
    {
        return view('konsultasi.show', compact('konsultasi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Konsultasi $konsultasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Konsultasi $konsultasi)
    {
        $request->validate([
            'status'=>'required|in:disetujui,ditolak',
            'catatan'=>'nullable|string|max:1000',
        ]);

        $konsultasi->update($request->only('status', 'catatan'));

        return redirect()->route('konsultasi.index')->with('success', 'Status berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Konsultasi $konsultasi)
    {
        //
    }
}
