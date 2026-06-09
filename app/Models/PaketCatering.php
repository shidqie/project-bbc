<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketCatering extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'harga', 'minimum_order', 'gambar'];

    public function detail()
    {
        return $this->hasMany(DetailPaketCatering::class);
    }
}
