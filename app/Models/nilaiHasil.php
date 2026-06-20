<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nilaiHasil extends Model
{
    protected $fillable = [
        'nim',
        'namaDosen',
        'tahunAkademik',
        'namaMataKuliah',
        'tugas',
        'uts',
        'uas',
        'status',
        'nilaiHuruf',
        'nilaiAngka',
        'bobotKualitas',
        'keterangan',
        'sks',
        'sksSemester',
        'ips',
        'kreditDiambil',
        'kreditPeroleh',
        'ipk',
    ];

    public function mahasiswa() {
        return $this->belongsTo(Pengguna::class, 'nim', 'id');
    }

    public function dosen() {
        return $this->belongsTo(Pengguna::class, 'namaDosen', 'id');
    }

    public function mataKuliah() {
        return $this->belongsTo(MataKuliah::class, 'namaMataKuliah', 'id');
    }
}
