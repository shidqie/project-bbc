<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $fillable = ['nama', 'satuan', 'stok', 'batas_minimum'];
}
