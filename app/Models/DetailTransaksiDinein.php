<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksiDinein extends Model
{
    protected $fillable = ['transaksi_dinein_id', 'menu_id', 'qty', 'harga_satuan', 'subtotal'];

    public function transaksi()
    {
        return $this->belongsTo(TransaksiDinein::class, 'transaksi_dinein_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
