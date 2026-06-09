<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['transaksi_type', 'transaksi_id', 'metode', 'jumlah_bayar', 'kembalian'];

    public function transaksi()
    {
        return $this->morphTo();
    }
}
