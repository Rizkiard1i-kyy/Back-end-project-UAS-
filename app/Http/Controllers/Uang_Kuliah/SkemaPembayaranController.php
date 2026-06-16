<?php

namespace App\Http\Controllers\Uang_Kuliah;

use App\Models\Skema_Pembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Auth;

class SkemaPembayaranController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $skema  = Skema_Pembayaran::where('user_id', $user->id)->latest()->first();

        return view('skema_pembayaran.index', compact('user', 'skema'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jenis_skema' => 'required|in:FULL PAYMENT,TERMIN',
        ]);

        $user = Auth::user();

        Skema_Pembayaran::updateOrCreate(
            ['user_id' => $user->id],
            ['jenis_skema' => $request->jenis_skema]
        );

        return redirect()->route('skema_pembayaran.index')
            ->with('success', 'Skema pembayaran berhasil dipilih.');
    }
}
