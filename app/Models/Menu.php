<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ['nama', 'kategori', 'harga', 'gambar', 'status'];

    public function komposisi()
    {
        return $this->hasMany(KomposisiMenu::class);
    }
}
