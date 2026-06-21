<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SkemaPembayaran;

class SkemaPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            SkemaPembayaran::create([
                'user_id' => 2,
                'jenis_skema' => 'TERMIN',
            ]);
    
            SkemaPembayaran::create([
                'user_id' => 3,
                'jenis_skema' => 'FULL PAYMENT',
            ]);
    
            SkemaPembayaran::create([
                'user_id' => 4,
                'jenis_skema' => 'FULL PAYMENT',
            ]);
    
            SkemaPembayaran::create([
                'user_id' => 5,
                'jenis_skema' => 'TERMIN',
            ]);

            SkemaPembayaran::create([
                'user_id' => 6,
                'jenis_skema' => 'FULL PAYMENT',
            ]);

            SkemaPembayaran::create([
                'user_id' => 7,
                'jenis_skema' => 'TERMIN',
            ]);
    }
}
