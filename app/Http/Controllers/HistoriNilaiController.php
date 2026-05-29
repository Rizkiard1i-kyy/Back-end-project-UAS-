<?php

namespace App\Http\Controllers;

use App\Models\historiNilai;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoriNilaiController extends Controller
{
    public function index()
    {
        $historiNilai = historiNilai::all();
        return view('historiNilais.index', compact('historiNilai'));
    }

    public function create()
    {
        return view('historiNilais.create');
    }

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
        return view('historiNilais.edit', compact('historiNilai'));
    }

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

    public function destroy(historiNilai $historiNilai)
    {
        $historiNilai->delete();
        return redirect()->route('historiNilai.index')->with('success', 'Data histori nilai dihapus.');
    }
}
