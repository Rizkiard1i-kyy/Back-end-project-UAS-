<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kehadiran extends Model
{
    protected $fillable = ['kodeMatkul', 'namaMatkul', 'semester', 'namaDosen', 'namaMahasiswa', 'kelas', 'jumlahPertemuan','jumlahKehadiran', 'persentase'];
}
