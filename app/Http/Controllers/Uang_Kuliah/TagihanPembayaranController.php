<?php

namespace App\Http\Controllers\Uang_Kuliah;

use App\Models\TagihanPembayaran;
use App\Models\SkemaPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagihanPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $query = TagihanPembayaran::with('user')
            ->orderByRaw("FIELD(status, 'BELUM LUNAS', 'LUNAS'), tahun_akademik DESC, tgl_batas_bayar ASC");

        if (!$user->isAdmin()) {
            $query->where('user_id', $user->id);
        }

        $tagihanGrouped = $query->get()->groupBy('tahun_akademik');

        return view('tagihan_pembayaran.index', compact('user', 'tagihanGrouped'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'            => 'required|exists:users,id',
            'tahun_akademik'     => 'required|string',
            'jenis'              => 'required|string',
            'no_virtual_account' => 'required|string',
            'tgl_batas_bayar'    => 'required|date',
            'tgl_mulai_bayar'    => 'nullable|date',
            'jumlah_tagihan'     => 'required|numeric',
            'rincian'            => 'nullable|string',
            'status'             => 'required|in:BELUM LUNAS,LUNAS',
        ]);

        TagihanPembayaran::create($request->all());

        return redirect()->route('tagihan_pembayaran.index')
            ->with('success', 'Data tagihan baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TagihanPembayaran $tagihanPembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TagihanPembayaran $tagihanPembayaran)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Anda Tidak boleh mengakses halaman ini.');
        }

        return view('tagihan_pembayaran.edit', compact('tagihanPembayaran'));   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TagihanPembayaran $tagihanPembayaran)
    {
        $request->validate([
            'tahun_akademik'     => 'required|string',
            'jenis'              => 'required|string',
            'no_virtual_account' => 'required|string',
            'tgl_batas_bayar'    => 'required|date',
            'jumlah_tagihan'     => 'required|numeric',
            'status'             => 'required|in:BELUM LUNAS,LUNAS',
            'bank'               => 'nullable|string',
            'tgl_pembayaran'     => 'nullable|date',
            'nominal_bayar'      => 'nullable|numeric',
            'rincian'            => 'nullable|string',
        ]);
        $tagihanPembayaran->update($request->all());

        return redirect()->route('tagihan_pembayaran.index')
            ->with('success', 'Data tagihan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TagihanPembayaran $tagihanPembayaran)
    {
        //
    }
}
