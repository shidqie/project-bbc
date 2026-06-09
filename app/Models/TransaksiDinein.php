<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiDinein extends Model
{
    protected $fillable = ['user_id', 'meja_id', 'total_harga', 'status_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class);
    }

    public function detail()
    {
        return $this->hasMany(DetailTransaksiDinein::class);
    }

    public function pembayaran()
    {
        return $this->morphMany(Pembayaran::class, 'transaksi');
    }
}
