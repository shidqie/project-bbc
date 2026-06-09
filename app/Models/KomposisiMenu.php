<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomposisiMenu extends Model
{
    protected $fillable = ['menu_id', 'bahan_baku_id', 'jumlah_kebutuhan'];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function bahanBaku()
    {
        return $this->belongsTo(BahanBaku::class);
    }
}
