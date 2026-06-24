<?php

namespace App\Http\Controllers\Uang_Kuliah;

use App\Models\SkemaPembayaran;
use App\Models\TagihanPembayaran;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SkemaPembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user   = Auth::user();

        if ($user->isAdmin()) {
        $skemas = SkemaPembayaran::with('mahasiswa')
            ->get()
            ->sortBy(fn ($s) => $s->mahasiswa->nama ?? '');

        return view('skema_pembayaran.index', compact('user', 'skemas'));
}

        $skema  = SkemaPembayaran::where('user_id', $user->id)->latest()->first();
        $rentang = [
            'full_mulai' => '2026-06-08',
            'full_batas' => '2026-07-09',
            'termin1_batas' => '2026-07-09',
            'termin2_batas' => '2026-08-29',
        ];

        return view('skema_pembayaran.index', compact('user', 'skema', 'rentang'));
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
            'jenis_skema' => 'required|in:FULL PAYMENT,TERMIN',
        ]);

        $user  = Auth::user();
        $tahun = '2026 GANJIL';
        
        SkemaPembayaran::updateOrCreate(
            ['user_id' => $user->id],
            ['jenis_skema' => $request->jenis_skema]
        );

        TagihanPembayaran::where('user_id', $user->id)
            ->whereIn('jenis', [
                'BPP (Full Payment)',
                'BPP (Termin 01)',
                'BPP (Termin 02)',
            ])
            ->delete();

        if ($request->jenis_skema == 'FULL PAYMENT') {
            TagihanPembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Full Payment)',
                'no_virtual_account' => '18888'.$user->nim.'10',
                'tgl_mulai_bayar'    => '2026-06-08',
                'tgl_batas_bayar'    => '2026-07-09',
                'jumlah_tagihan'     => 9000000,
                'rincian'            => 'BPP: Rp. 9,000,000',
                'status'             => 'BELUM LUNAS',
            ]);
        } else {
            TagihanPembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 01)',
                'no_virtual_account' => '18888'.$user->nim.'11',
                'tgl_mulai_bayar'    => '2026-06-08',
                'tgl_batas_bayar'    => '2026-07-09',
                'jumlah_tagihan'     => 5355000,
                'rincian'            => 'BPP Termin 01: Rp. 5,355,000',
                'status'             => 'BELUM LUNAS',
            ]);

            TagihanPembayaran::create([
                'user_id'            => $user->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 02)',
                'no_virtual_account' => '18888'.$user->nim.'12',
                'tgl_mulai_bayar'    => '2026-06-08',
                'tgl_batas_bayar'    => '2026-08-29',
                'jumlah_tagihan'     => 3645000,
                'rincian'            => 'BPP Termin 02: Rp. 3,645,000',
                'status'             => 'BELUM LUNAS',
            ]);
        }

        return redirect()->route('skema_pembayaran.index')->with('success', 'Skema pembayaran berhasil disimpan dan tagihan diperbarui.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SkemaPembayaran $skemaPembayaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SkemaPembayaran $skemaPembayaran)
    {
        $user = Auth::user();
        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $skemaPembayaran->load('mahasiswa'); 

        $tagihans = TagihanPembayaran::where('user_id', $skemaPembayaran->user_id)
            ->whereIn('jenis', [
                'BPP (Full Payment)',
                'BPP (Termin 01)',
                'BPP (Termin 02)',
            ])
            ->get()
            ->keyBy('jenis');
        
        return view('skema_pembayaran.edit', compact('skemaPembayaran', 'user', 'tagihans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SkemaPembayaran $skemaPembayaran)
    {
        $user = Auth::user();

        if (!$user->isAdmin()) {
            abort(403, 'Anda tidak boleh mengakses halaman ini.');
        }

        $request->validate([
            'tgl_mulai'         => 'nullable|date',
            'tgl_batas_full'    => 'nullable|date',
            'tgl_batas_termin1' => 'nullable|date',
            'tgl_batas_termin2' => 'nullable|date',
        ]);

        $tahun = '2026 GANJIL';
        
        $skemaPembayaran->load('mahasiswa');
        $mahasiswa = $skemaPembayaran->mahasiswa;

        TagihanPembayaran::where('user_id', $mahasiswa->id)
            ->whereIn('jenis', [
                'BPP (Full Payment)',
                'BPP (Termin 01)',
                'BPP (Termin 02)',
            ])
            ->delete();
        if ($skemaPembayaran->jenis_skema == 'FULL PAYMENT') {
            TagihanPembayaran::create([
                'user_id'            => $mahasiswa->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Full Payment)',
                'no_virtual_account' => '18888' . $mahasiswa->nim . '10',
                'tgl_mulai_bayar'    => $request->tgl_mulai ?: '2026-06-08',
                'tgl_batas_bayar'    => $request->tgl_batas_full ?: '2026-07-09',
                'jumlah_tagihan'     => 9000000,
                'rincian'            => 'BPP: Rp. 9,000,000',
                'status'             => 'BELUM LUNAS',
            ]);
        } else {
            TagihanPembayaran::create([
                'user_id'            => $mahasiswa->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 01)',
                'no_virtual_account' => '18888' . $mahasiswa->nim . '11',
                'tgl_mulai_bayar'    => $request->tgl_mulai ?: '2026-06-08',
                'tgl_batas_bayar'    => $request->tgl_batas_termin1 ?: '2026-07-09',
                'jumlah_tagihan'     => 5355000,
                'rincian'            => 'BPP Termin 01: Rp. 5,355,000',
                'status'             => 'BELUM LUNAS',
            ]);

            TagihanPembayaran::create([
                'user_id'            => $mahasiswa->id,
                'tahun_akademik'     => $tahun,
                'jenis'              => 'BPP (Termin 02)',
                'no_virtual_account' => '18888' . $mahasiswa->nim . '12',
                'tgl_mulai_bayar'    => $request->tgl_mulai ?: '2026-06-08',
                'tgl_batas_bayar'    => $request->tgl_batas_termin2 ?: '2026-08-29',
                'jumlah_tagihan'     => 3645000,
                'rincian'            => 'BPP Termin 02: Rp. 3,645,000',
                'status'             => 'BELUM LUNAS',
            ]);
        }
        
        return redirect()->route('skema_pembayaran.index')->with('success', 'Skema pembayaran dan tagihan mahasiswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SkemaPembayaran $skemaPembayaran)
    {
        //
    }
}
