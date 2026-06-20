<?php

namespace App\Http\Controllers\Uang_Kuliah;

use App\Models\Skema_Pembayaran;
use App\Models\Tagihan_Pembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkemaPembayaranController extends Controller
{
    
    protected string $tahunAkademikAktif = '2026 GANJIL';

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

        $user  = Auth::user();
        $tahun = $this->tahunAkademikAktif;

        Skema_Pembayaran::updateOrCreate(
            ['user_id' => $user->id],
            ['jenis_skema' => $request->jenis_skema]
        );

        Tagihan_Pembayaran::where('user_id', $user->id)
            ->where('tahun_akademik', $tahun)
            ->whereIn('jenis', [
                'BPP (Full Payment)',
                'BPP (Termin 01)',
                'BPP (Termin 02)',
            ])
            ->delete();

        if ($request->jenis_skema === 'FULL PAYMENT') {
            Tagihan_Pembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Full Payment)',
                'no_virtual_account' => '1888853525014610',
                'tgl_batas_bayar'    => '2026-07-09',
                'jumlah_tagihan'     => 9000000,
                'rincian'            => 'BPP: Rp. 9,000,000',
                'status'             => 'BELUM LUNAS',
            ]);
        } else {
            Tagihan_Pembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 01)',
                'no_virtual_account' => '1888853525014611',
                'tgl_batas_bayar'    => '2026-07-09',
                'jumlah_tagihan'     => 5535000,
                'rincian'            => 'BPP Termin 01: Rp. 5,535,000',
                'status'             => 'BELUM LUNAS',
            ]);

            Tagihan_Pembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 02)',
                'no_virtual_account' => '1888853525014612',
                'tgl_batas_bayar'    => '2026-08-23',
                'jumlah_tagihan'     => 3690000,
                'rincian'            => 'BPP Termin 02: Rp. 3,690,000',
                'status'             => 'BELUM LUNAS',
            ]);
        }

        return redirect()->route('tagihan_pembayaran.index')
            ->with('success', 'Skema pembayaran berhasil dipilih, tagihan telah dibuat.');
    }
}
