<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nilaiKHS extends Model
{
    protected $fillable = [
        'nim',
        'tahunAkademik',
        'tugas',
        'uts',
        'uas',

        'kodeMK',
        'namaMataKuliah',
        'status',
        'sks',
        'nilaiHuruf',
        'nilaiAngka',
        'bobotKualitas',
        'keterangan',
        
        'jumlahSKS',
        'ips',
        'kreditDiambil',
        'kreditPeroleh',
        'ipk',
    ];
}
