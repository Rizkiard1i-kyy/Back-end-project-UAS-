<?php

namespace App\Http\Controllers\Uang_Kuliah;

use App\Models\Tagihan_Pembayaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TagihanPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        $tagihanGrouped = Tagihan_Pembayaran::where('user_id', $user->id)
            ->orderByRaw("FIELD(status, 'BELUM LUNAS', 'LUNAS')")
            ->orderBy('tahun_akademik', 'desc')
            ->orderBy('tgl_batas_bayar')
            ->get()
            ->groupBy('tahun_akademik');

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tagihan_Pembayaran $tagihan_Pembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tagihan_Pembayaran $tagihan_Pembayaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tagihan_Pembayaran $tagihan_Pembayaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tagihan_Pembayaran $tagihan_Pembayaran)
    {
        //
    }
}
