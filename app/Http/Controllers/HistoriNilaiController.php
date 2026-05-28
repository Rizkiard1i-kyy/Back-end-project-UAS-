<?php

namespace App\Http\Controllers;

use App\Models\historiNilai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriNilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $historiNilai = historiNilai::all();
        return view('historiNilais.index', compact('historiNilai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('historiNilais.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nim'=>'required|string|max:9',
            'tahunAkademik'=>'required|integer|min:19591',
            'kode'=>'required|string|min:1',
            'mataKuliah'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
            'nilai'=>'required|string|max:1',
            'bobot'=>'required|integer|max:4',
        ]);

        historiNilai::create($request->only('nim', 'tahunAkademik', 'kode', 'mataKuliah', 'sks', 'nilai', 'bobot'));

        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai baru dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(historiNilai $historiNilai)
    {
        return view('historiNilais.show', compact('historiNilai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(historiNilai $historiNilai)
    {
        return view('historiNilais.edit', compact('historiNilai'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, historiNilai $historiNilai)
    {
        $request->validate([
            'nim'=>'required|string|max:9',
            'tahunAkademik'=>'required|integer|min:19591',
            'kode'=>'required|string|min:7',
            'mataKuliah'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
            'nilai'=>'required|string|max:1',
            'bobot'=>'required|float|max:4.00',
        ]);

        historiNilai::create($request->only('nim', 'tahunAkademik', 'kode', 'mataKuliah', 'sks', 'nilai', 'bobot'));

        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai baru dibuat.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(historiNilai $historiNilai)
    {
        $historiNilai->delete();

        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai dihapus.');
    }
}
