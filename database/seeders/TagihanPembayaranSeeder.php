<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tagihan_Pembayaran;

class TagihanPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Tagihan_Pembayaran::create([
            'user_id' => 2,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525013011',
            'jenis' => 'BPP (Termin 01)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 5535000,
            'rincian' => 'BPP: Rp 5.535.000',
            'bank' => 'Bank XYZ',
            'status' => 'BELUM LUNAS',
        ]);

        Tagihan_Pembayaran::create([
            'user_id' => 3,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525013310',
            'jenis' => 'BPP (Full Payment)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 9000000,
            'rincian' => 'BPP: Rp 9.000.000',
            'bank' => 'Bank ABC',
            'status' => 'BELUM LUNAS',
        ]);

        Tagihan_Pembayaran::create([
            'user_id' => 4,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525013510',
            'jenis' => 'BPP (Full Payment)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 9000000,
            'rincian' => 'BPP: Rp 9.000.000',
            'bank' => 'Bank ABC',
            'status' => 'BELUM LUNAS',
        ]);

        Tagihan_Pembayaran::create([
            'user_id' => 5,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525012711',
            'jenis' => 'BPP (Termin 01)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 5355000,
            'rincian' => 'BPP Termin 01 Semester Ganjil 2026',
            'bank' => 'Bank XYZ',
            'status' => 'BELUM LUNAS',
        ]);

        Tagihan_Pembayaran::create([
            'user_id' => 6,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525014110',
            'jenis' => 'BPP (Full Payment)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 9000000,
            'rincian' => 'BPP: Rp 9.000.000',
            'bank' => 'Bank ABC',
            'status' => 'BELUM LUNAS',
        ]);

        Tagihan_Pembayaran::create([
            'user_id' => 7,
            'tahun_akademik' => '2026 Ganjil',
            'no_virtual_account' => '1888853525014610',
            'jenis' => 'BPP (Termin 01)',
            'tgl_batas_bayar' => '2026-07-09',
            'jumlah_tagihan' => 5355000,
            'rincian' => 'BPP Termin 01 Semester Ganjil 2026',
            'bank' => 'Bank XYZ',
            'status' => 'BELUM LUNAS',
        ]);
    }
}
