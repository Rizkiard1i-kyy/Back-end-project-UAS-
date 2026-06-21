<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ksm;

class KsmSeeder extends Seeder
{
    
    private array $mataKuliahs = [
        ['kodeMatkul' => 'TK101', 'namaMatkul' => 'Algebra Discrete', 'sks' => 4, 'kelas' => 'C', 'status' => 'B'],
        ['kodeMatkul' => 'TK102', 'namaMatkul' => 'Data Structures', 'sks' => 4, 'kelas' => 'C', 'status' => 'B'],
        ['kodeMatkul' => 'TK103', 'namaMatkul' => 'Intro to AI', 'sks' => 2, 'kelas' => 'C', 'status' => 'B'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mahasiswas = [
            ['nama' => 'Hartono',   'nim' => '535250130'],
            ['nama' => 'Jhon',      'nim' => '535250133'],
            ['nama' => 'Joseph',    'nim' => '535250135'],
            ['nama' => 'rizki',     'nim' => '535250127'],
            ['nama' => 'Christian', 'nim' => '535250141'],
            ['nama' => 'Joshua',    'nim' => '535250146'],
        ];
 
        foreach ($mahasiswas as $mhs) {
            $ksm = Ksm::create([
                'nama'          => $mhs['nama'],
                'nim'           => $mhs['nim'],
                'prodi'         => 'Teknik Informatika',
                'semester'      => '2',
                'tahunAkademik' => '2025/2026',
            ]);
 
            foreach ($this->mataKuliahs as $index => $mk) {
                $ksm->mataKuliahs()->create([
                    'no'         => $index + 1,
                    'kodeMatkul' => $mk['kodeMatkul'],
                    'namaMatkul' => $mk['namaMatkul'],
                    'sks'        => $mk['sks'],
                    'kelas'      => $mk['kelas'],
                    'status'     => $mk['status'],
                ]);
            }
        }
    }
}
