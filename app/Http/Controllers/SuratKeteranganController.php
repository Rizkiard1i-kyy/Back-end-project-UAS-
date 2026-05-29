<?php

namespace App\Http\Controllers;

use App\Models\SuratKeterangan;
use Illuminate\Http\Request;

class SuratKeteranganController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if ($user->isAdmin()) {

            $suratKeterangan = SuratKeterangan::query()
            ->latest('tanggal_pengajuan')
            ->get();
        } else {

            $suratKeterangan = SuratKeterangan::where(
                'nim',
                $user->nim
            )->latest('tanggal_pengajuan')->get();
        }

        return view(
            'surat_keterangan.index',
            compact('suratKeterangan')
        );
    }

    public function create()
    {
        return view('surat_keterangan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_surat' => 'required',
            'bahasa'      => 'required',
        ]);

        SuratKeterangan::create([
            'nim'         => auth()->user()->nim,
            'jenis_surat' => $request->jenis_surat,
            'bahasa'      => $request->bahasa,
        ]);

        return redirect()
            ->route('surat_keterangan.index')
            ->with('success', 'Surat berhasil dibuat.');
    }

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

    public function edit(SuratKeterangan $suratKeterangan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        return view('surat_keterangan.edit', compact('suratKeterangan'));
    }

    public function update(Request $request, SuratKeterangan $suratKeterangan)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:pending,accepted,decline',
        ]);

        $suratKeterangan->update([
            'status' => $request->status,
        ]);

        return redirect()
            ->route('surat_keterangan.index')
            ->with('success', 'Status surat berhasil diupdate.');
    }

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
