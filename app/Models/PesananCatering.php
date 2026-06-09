<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananCatering extends Model
{
    protected $fillable = ['pelanggan_id', 'paket_catering_id', 'qty', 'tanggal_kirim', 'total_harga', 'catatan', 'status'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function paket()
    {
        return $this->belongsTo(PaketCatering::class, 'paket_catering_id');
    }

    // Alias agar kompatibel dengan nama paketCatering
    public function paketCatering()
    {
        return $this->belongsTo(PaketCatering::class, 'paket_catering_id');
    }

    public function pembayaran()
    {
        return $this->morphMany(Pembayaran::class, 'transaksi');
    }
}
