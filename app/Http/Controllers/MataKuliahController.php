<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MataKuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $mataKuliah = MataKuliah::all();

        return view('matakuliahs.index', compact('mataKuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }
        return view('matakuliahs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
        ]);

        MataKuliah::create($request->only('kodeMatkul','namaMatkul','sks'));

        return redirect()->route('mataKuliah.index')->with('success', 'Data mata kuliah baru dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        return view('matakuliahs.show', compact('mataKuliah'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        return view('matakuliahs.edit', compact('mataKuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $request->validate([
            'kodeMatkul'=>'required|string|max:7',
            'namaMatkul'=>'required|string|max:255',
            'sks'=>'required|integer|min:1',
        ]);

        $mataKuliah->update($request->only('kodeMatkul','namaMatkul','sks'));

        return redirect()->route('mataKuliah.index')->with('success', 'Data mata kuliah diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {   
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $mataKuliah->delete();

        return redirect()->route('mataKuliah.index')->with('success', 'Data mata kuliah dihapus.');
    }
}
