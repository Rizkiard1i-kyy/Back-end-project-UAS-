<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historiNilai extends Model
{

    protected $fillable = [
        'nim',
        'tahunAkademik',
        'kode',
        'mataKuliah',
        'sks',
        'nilai',
        'bobot',
    ];
}
