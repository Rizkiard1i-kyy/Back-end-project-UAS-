<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MataKuliah::create([
            'kodeMatkul'     => 'TK13030',
            'namaMatkul'    => 'NUMERICAL METHOD',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13034',
            'namaMatkul'    => 'OPERATING SYSTEMS',
            'sks'      => '2',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13038',
            'namaMatkul'    => 'ALGEBRA & DISCRETE MATHEMATICS',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13039',
            'namaMatkul'    => 'INTRODUCTION TO ARTIFICIAL INTELLIGENCE',
            'sks'      => '2',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK23007',
            'namaMatkul'    => 'DATA STRUCTURES',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK23022',
            'namaMatkul'    => 'BACK-END PROGRAMMING',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13032',
            'namaMatkul'    => 'TECHNOLOGY AND ETHICS',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13021',
            'namaMatkul'    => 'DATABASE SYSTEMS',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13027',
            'namaMatkul'    => 'ALGORITHMS',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13028',
            'namaMatkul'    => 'FUNDAMENTAL PROGRAMMING',
            'sks'      => '4',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13036',
            'namaMatkul'    => 'STATISTICS',
            'sks'      => '2',
        ]);

        MataKuliah::create([
            'kodeMatkul'     => 'TK13037',
            'namaMatkul'    => 'CALCULUS',
            'sks'      => '2',
        ]);
    }
}
