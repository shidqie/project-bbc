<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaketNasibox extends Model
{
    protected $fillable = ['nama', 'deskripsi', 'harga', 'gambar'];

    public function detail()
    {
        return $this->hasMany(DetailPaketNasibox::class);
    }
}
