<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananNasibox extends Model
{
    protected $fillable = ['pelanggan_id', 'paket_nasibox_id', 'qty', 'tanggal_kirim', 'total_harga', 'catatan', 'status'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketNasibox::class, 'paket_nasibox_id');
    }

    // Alias agar kompatibel dengan nama paketNasibox
    public function paketNasibox()
    {
        return $this->belongsTo(PaketNasibox::class, 'paket_nasibox_id');
    }

    public function pembayaran()
    {
        return $this->morphMany(Pembayaran::class, 'transaksi');
    }
}
