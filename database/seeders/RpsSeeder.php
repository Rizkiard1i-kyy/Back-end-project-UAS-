<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rps;

class RpsSeeder extends Seeder
{
    public function run(): void
    {
        Rps::create([
            'kode_mk'  => 'TK13017',
            'nama_mk'  => 'SISTEM INFORMASI/INFORMATION SYSTEMS',
            'sks'      => 2,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing', 
        ]);
        Rps::create([
            'kode_mk'  => 'TK13020',
            'nama_mk'  => 'INTRODUCTION TO ALGORITHMS/INTRODUCTION TO ALGORITHMS',
            'sks'      => 8,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK13022',
            'nama_mk'  => 'IT TRENDS/IT TRENDS',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK23006',
            'nama_mk'  => 'METODE NUMERIK/NUMERICAL METHODS',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK23007',
            'nama_mk'  => 'STRUKTUR DATA/DATA STRUCTURE',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK23009',
            'nama_mk'  => 'P. B. O. DG JAVA 1/OBJECT ORIENTED PROGRAMMING WITH JAVA 1',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK23010',
            'nama_mk'  => 'SISTEM OPERASI/OPERATING SYSTEMS',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK23011',
            'nama_mk'  => 'SISTEM BASIS DATA DAN PRAKTIKUM ORACLE/DATABASE SYSTEMS',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK33003',
            'nama_mk'  => 'TEKNIK KOMPILASI/COMPILATION TECHNIQUES',
            'sks'      => 2,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
        Rps::create([
            'kode_mk'  => 'TK33004',
            'nama_mk'  => 'PEMROGRAMAN BERORIENTASI OBYEK DG JAVA 2/OBJECT ORIENTED PROGRAMMING WITH JAVA 2',
            'sks'      => 4,
            'file_rps' => 'https://docs.google.com/document/d/1wCwaaxmq8w_0lo8ThALcqymBaXv5jZOtb0Z43yANm20/edit?usp=sharing',
        ]);
    }
}