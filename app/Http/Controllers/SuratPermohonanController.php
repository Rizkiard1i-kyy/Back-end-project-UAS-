<?php

namespace App\Http\Controllers;

use App\Models\SuratPermohonan;
use Illuminate\Http\Request;

class SuratPermohonanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }
             if ($user->isAdmin()) {

            $suratPermohonan = SuratPermohonan::query()
            ->latest('tanggal_pengajuan')
            ->get();
        } else {

            $suratPermohonan = SuratPermohonan::where(
                'nim',
                $user->nim
            )->latest('tanggal_pengajuan')->get();
        }

        return view(
            'surat_permohonan.index',
            compact('suratPermohonan')
        );
        }
        

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('surat_permohonan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'bahasa'      => 'required',
        ]);

        SuratPermohonan::create([
            'nim'         => auth()->user()->nim,
            'jenis_surat' => $request->jenis_surat,
            'bahasa'      => $request->bahasa,
        ]);

        return redirect()
            ->route('surat_permohonan.index')
            ->with('success', 'Surat berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPermohonan $suratPermohonan)
    {
        if (
            !auth()->user()->isAdmin() &&
            $suratPermohonan->nim != auth()->user()->nim
        ) {
            abort(403);
        }

        return view(
            'surat_permohonan.show',
            compact('suratPermohonan')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPermohonan $suratPermohonan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('surat_permohonan.edit', compact('suratPermohonan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratPermohonan $suratPermohonan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,decline',
        ]);

        $suratPermohonan->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('surat_permohonan.index')
            ->with('success', 'Status surat berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuratPermohonan $suratPermohonan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $suratPermohonan->delete();

        return redirect()
            ->route('surat_permohonan.index')
            ->with('success', 'Surat berhasil dihapus.');
    }
}
