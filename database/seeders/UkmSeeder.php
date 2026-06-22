<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ukm;
use App\Models\Pengguna;

class UkmSeeder extends Seeder
{
    public function run(): void
    {
        $mahasiswa = Pengguna::where('role', 'mahasiswa')->get();

        ukm::create([
            'nama'          => 'Tarumanagara English Club',
            'nim'           => $mahasiswa[2]->id,
            'anggota'       => '200',
            'detail'        => 'Our organization focuses on developing our English language skills.',
        ]);
        ukm::create([
            'nama'          => 'Soushin Tarumanagara Nihonbu',
            'nim'           => $mahasiswa[1]->id,
            'anggota'       => '120',
            'detail'        => 'Our organization focuses on japanense culture such as manga, 
                                cosplay, caligraphy, and other event related to Japan.',
        ]);ukm::create([
            'nama'          => 'Dharmayana',
            'nim'           => $mahasiswa[0]->id,
            'anggota'       => '243',
            'detail'        => 'UKM kami mewadahi mahasiswa Buddhis 
                                untuk menyelenggarakan kegiatan kerohanian, edukasi, dan bakti sosial berskala besar.',
        ]);ukm::create([
            'nama'          => 'MAPALA FTI UNTAR',
            'nim'           => $mahasiswa[4]->id,
            'anggota'       => '100',
            'detail'        => 'Bagi kalian yang ingin sky diving, panjang tebing, dan menaiki arung jeram, 
                                YUKK BERGABUNG DI UKM KAMI. MAPALA  (Mahasiswa Pecinta Alam).',
        ]);
    }
}