<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KalenderAkademik extends Model
{
    protected $fillable = [
        'tanggalMulai', 
        'tanggalSelesai', 
        'namaKegiatan',
        'tahunAkademik'
    ];

    protected $casts = [
        'tanggalMulai'=>'date',
        'tanggalSelesai'=>'date',
    ];
}
