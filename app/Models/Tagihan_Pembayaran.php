<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan_Pembayaran extends Model
{
    protected $table = 'tagihan_pembayaran';
    protected $primaryKey = 'id_tagihan_pembayaran';
    protected $fillable = [
        'id_tagihan',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
        'metode_pembayaran',
        'bukti_pembayaran',
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class, 'id_tagihan');
    }
}
