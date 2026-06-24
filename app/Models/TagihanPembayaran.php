<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TagihanPembayaran extends Model
{
    protected $fillable = [
        'user_id',
        'tahun_akademik',
        'jenis',
        'no_virtual_account',
        'tgl_batas_bayar',
        'tgl_mulai_bayar',
        'jumlah_tagihan',
        'rincian',
        'bank',
        'tgl_pembayaran',
        'nominal_bayar',
        'status',
    ];

        protected $casts = [
            'tgl_batas_bayar'  => 'date',
            'tgl_mulai_bayar'  => 'date',
            'tgl_pembayaran'   => 'date',
        ];

    public function user()
    {
        return $this->belongsTo(\App\Models\Pengguna::class, 'user_id');
    }
}
