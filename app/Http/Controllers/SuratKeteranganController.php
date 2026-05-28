<?php

namespace App\Http\Controllers;

use App\Models\SuratKeterangan;
use Illuminate\Http\Request;

class SuratKeteranganController extends Controller
    {
    /**
     * Display a listing of the resource.
     */
public function index()
    {
    if (auth()->user()->isAdmin()) {

        $suratKeterangan = SuratKeterangan::all();

    } else {

        $suratKeterangan = SuratKeterangan::where(
            'nim',
            auth()->user()->nim
        )->get();
    }

    return view(
        'surat_keterangan.index',
        compact('suratKeterangan')
    );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view("surat_keterangan.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    $request->validate([
        'jenis_surat' => 'required',
        'bahasa' => 'required',
    ]);

    SuratKeterangan::create([

        'nim' => auth()->user()->nim,

        'jenis_surat' => $request->jenis_surat,

        'bahasa' => $request->bahasa,
    ]);

    return redirect()
        ->route('surat_keterangan.index')
        ->with('success', 'Surat berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKeterangan $suratKeterangan)
    {
    if (
        !auth()->user()->isAdmin() &&
        $suratKeterangan->nim != auth()->user()->nim
    ) {
        abort(403);
    }

    return view(
        'surat_keterangan.show',
        compact('suratKeterangan')
    );
    }

    /**
     * Show the form for editing the specified resource.
     */
public function edit(SuratKeterangan $suratKeterangan)
{
    if (!auth()->user()->isAdmin()) {
        abort(403);
    }

    return view('surat_keterangan.edit', compact('suratKeterangan'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratKeterangan $suratKeterangan)
{
    if (!auth()->user()->isAdmin()) {
        abort(403);
    }

    $request->validate([
        'status' => 'required|in:pending,accepted,decline',
    ]);

    $suratKeterangan->update([
        'status' => $request->status
    ]);

    return redirect()
        ->route('surat_keterangan.index')
        ->with('success', 'Status surat berhasil diupdate.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratKeterangan $suratKeterangan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $suratKeterangan->delete();

        return redirect()
            ->route('surat_keterangan.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}
