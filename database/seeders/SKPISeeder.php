<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Skpi;
use App\Models\Pengguna;

class SkpiSeeder extends Seeder
{
    private function hitungPoin($klasifikasi)
    {
        if ($klasifikasi == 'Peserta') {
            return 20;
        } elseif ($klasifikasi == 'Panitia') {
            return 35;
        } elseif ($klasifikasi == 'Ketua Umum') {
            return 50;
        }
        return 0;
    }
    
    public function run(): void
    {
        $mahasiswa = Pengguna::where('role', 'mahasiswa')->get();
        if ($mahasiswa->isEmpty()) {
            return;
        }

        Skpi::create([
            'user_id'     => $mahasiswa[0]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-10',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[0]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-15',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);

        Skpi::create([
            'user_id'     => $mahasiswa[1]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-12',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[1]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Panitia',
            'tgl_input'   => '2026-04-20',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Panitia')
        ]);

        Skpi::create([
            'user_id'     => $mahasiswa[2]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Panitia',
            'tgl_input'   => '2026-05-18',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Panitia')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[2]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-22',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);

        Skpi::create([
            'user_id'     => $mahasiswa[3]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-25',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[3]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-06-01',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);

        Skpi::create([
            'user_id'     => $mahasiswa[4]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-06-02',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[4]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Ketua Umum',
            'tgl_input'   => '2026-06-05',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Ketua Umum')
        ]);
        
        Skpi::create([
            'user_id'     => $mahasiswa[5]->id,
            'kegiatan'    => 'Welcoming Party 2025',
            'jenis'       => 'Acara Kampus',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-05-30',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
        Skpi::create([
            'user_id'     => $mahasiswa[5]->id,
            'kegiatan'    => 'informatic exhibition',
            'jenis'       => 'Pameran',
            'klasifikasi' => 'Peserta',
            'tgl_input'   => '2026-06-02',
            'bukti'       => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
            'validasi'    => 'Belum',
            'point'       => $this->hitungPoin('Peserta')
        ]);
    }
}