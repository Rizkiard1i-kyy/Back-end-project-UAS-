<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
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