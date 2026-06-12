<?php

namespace App\Http\Controllers;

use app\Models\Skema_Pembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 

class SkemaPembayaranController extends Controller
{
    public function index()
    {
        $skemaPembayaran = Skema_Pembayaran::all();
        return view('skema_pembayaran.index', compact('skemaPembayaran'));
    }

    public function create()
    {
        return view('skema_pembayaran.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'namaSkema' => 'required',
            'jumlahCicilan' => 'required|integer',
            'jumlahPembayaran' => 'required|numeric',
            'tanggalJatuhTempo' => 'required|date',
        ]);

        Skema_Pembayaran::create($request->all());

        return redirect()->route('skema_pembayaran.index')
                         ->with('success', 'Skema Pembayaran berhasil ditambahkan.');
    }
}
