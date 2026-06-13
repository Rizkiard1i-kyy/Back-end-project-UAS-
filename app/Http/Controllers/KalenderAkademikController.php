<?php

namespace App\Http\Controllers;

use App\Models\KalenderAkademik;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class KalenderAkademikController extends Controller
{  
    public function index()
    {
        $kalenderAkademik = KalenderAkademik::orderBy('tanggalMulai', 'asc')->get();
        return view('kalenderAkademiks.index', compact('kalenderAkademik'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data kalender akademik.');
        }

        return view('kalenderAkademiks.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh membuat data kalender akademik.');
        }

        $request->validate([
            'tanggalMulai'=>'required|date',
            'tanggalSelesai'=>'required|date|after_or_equal:tanggalMulai',
            'namaKegiatan'=>'required|string|max:255',
        ]);

         KalenderAkademik::create($request->only(
            'tanggalMulai', 
            'tanggalSelesai', 
            'namaKegiatan'));

        return redirect()->route('kalenderAkademik.index')->with('success', 'Data kalender akademik baru dibuat.');
    }

    public function show(KalenderAkademik $kalenderAkademik)
    {
        //
    }

    public function edit(KalenderAkademik $kalenderAkademik)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah data kalender akademik.');
        }

        return view('kalenderakademiks.edit', compact('kalenderAkademik'));
    }

    public function update(Request $request, KalenderAkademik $kalenderAkademik)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengubah data kalender akademik.');
        }

        $request->validate([
            'tanggalMulai'=>'required|date',
            'tanggalSelesai'=>'required|date|after_or_equal:tanggalMulai',
            'namaKegiatan'=>'required|string|max:255',
        ]);

        $kalenderAkademik->update($request->only('tanggalMulai', 'tanggalSelesai', 'namaKegiatan'));

        return redirect()->route('kalenderAkademik.index')->with('success', 'Data kalender akademik diperbarui.');
    }

    public function destroy(KalenderAkademik $kalenderAkademik)
    {
        if (!auth()->user()->isAdmin()) {   
            abort(403, 'Anda tidak boleh menghapus data kalender akademik.');
        }

        $kalenderAkademik->delete();

        return redirect()->route('kalenderAkademik.index')->with('success', 'Data kalender akademik dihapus.');
    }
}
