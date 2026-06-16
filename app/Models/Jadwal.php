<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    protected $fillable = [
        'tahun_akademik',
        'matkul', 
        'kelas', 
        'dosenPengajar', 
        'ruangDanWaktu',  
        'kodeMSteams', 
    ];

    public function dosen() {
        return $this->belongsTo(Pengguna::class, 'dosenPengajar', 'id');
    }
    
    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class, 'matkul', 'id');
    }
}