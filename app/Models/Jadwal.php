<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'tahun_akademik',
        'kodeMK', 
        'namaMK', 
        'sks', 
        'kelas', 
        'dosenPengajar', 
        'ruangDanWaktu',  
        'kodeMSteams', 
        'emailDosen'
    ];
}