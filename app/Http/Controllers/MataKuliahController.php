<?php

namespace App\Http\Controllers;

use App\Models\MataKuliah;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MataKuliahController extends Controller
{
    public function index()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $mataKuliah = MataKuliah::all();

        return view('matakuliahs.index', compact('mataKuliah'));
    }

    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }
        return view('matakuliahs.create');
    }

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

    public function show(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        return view('matakuliahs.show', compact('mataKuliah'));
    }

    public function edit(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        return view('matakuliahs.edit', compact('mataKuliah'));
    }

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

    public function destroy(MataKuliah $mataKuliah)
    {
        if (!auth()->user()->isAdmin()) {   
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }
        DB::table('jadwals')->where('matkul', $mataKuliah->id)->delete();
        DB::table('kehadirans')->where('matkul', $mataKuliah->id)->delete();
        DB::table('histori_nilais')->where('namaMataKuliah', $mataKuliah->id)->delete();
        DB::table('nilai_hasils')->where('namaMataKuliah', $mataKuliah->id)->delete();
        $mataKuliah->delete();

        return redirect()->route('mataKuliah.index')->with('success', 'Data mata kuliah dihapus.');
    }
}
