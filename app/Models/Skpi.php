<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skpi extends Model
{
    use HasFactory;

    protected $table = 'skpis';

    protected $fillable = [
        'user_id',
        'kegiatan',
        'jenis',
        'klasifikasi',
        'tgl_input',
        'bukti',
        'validasi',
        'point'
];
}