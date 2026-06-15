<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan_Pembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'tahun_akademik',
        'jenis',
        'no_virtual_account',
        'tgl_batas_bayar',
        'jumlah_tagihan',
        'rincian',
        'bank',
        'tgl_pembayaran',
        'nominal_bayar',
        'status',
    ];

    protected $casts = [
        'tgl_batas_bayar'  => 'date',
        'tgl_pembayaran'   => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\pengguna::class, 'user_id');
    }
}
