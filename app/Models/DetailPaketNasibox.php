<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPaketNasibox extends Model
{
    protected $fillable = ['paket_nasibox_id', 'menu_id', 'jumlah_porsi'];

    public function paket()
    {
        return $this->belongsTo(PaketNasibox::class, 'paket_nasibox_id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }
}
