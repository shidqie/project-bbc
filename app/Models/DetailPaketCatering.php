<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPaketCatering extends Model
{
    protected $fillable = ['paket_catering_id', 'menu_id', 'jumlah_porsi'];

    public function paket()
    {
        return $this->belongsTo(PaketCatering::class, 'paket_catering_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
