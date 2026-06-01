<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Pengguna;

class SuratPermohonan extends Model
{
     protected $table = 'surat_permohonans';

    protected $primaryKey = 'no';

    public $timestamps = false;

    protected $fillable = [
        'nim',
        'jenis_surat',
        'bahasa',
        'status'
    ];

    public function pengguna()
    {
        return $this->belongsTo(
            Pengguna::class,
            'nim',
            'nim'
        );
    }
}

