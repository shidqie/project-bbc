<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MoreMenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            ['nama' => 'Nasi Goreng Seafood', 'kategori' => 'makanan', 'harga' => 35000, 'status' => 'aktif'],
            ['nama' => 'Mie Goreng Jawa', 'kategori' => 'makanan', 'harga' => 22000, 'status' => 'aktif'],
            ['nama' => 'Ayam Bakar Madu', 'kategori' => 'makanan', 'harga' => 28000, 'status' => 'aktif'],
            ['nama' => 'Sate Ayam Madura (10 Tusuk)', 'kategori' => 'makanan', 'harga' => 30000, 'status' => 'aktif'],
            ['nama' => 'Gurame Asam Manis', 'kategori' => 'makanan', 'harga' => 65000, 'status' => 'aktif'],
            ['nama' => 'Capcay Kuah Seafood', 'kategori' => 'makanan', 'harga' => 32000, 'status' => 'aktif'],
            ['nama' => 'Bebek Goreng Sambal Ijo', 'kategori' => 'makanan', 'harga' => 38000, 'status' => 'aktif'],
            ['nama' => 'Kopi Hitam Tubruk', 'kategori' => 'minuman', 'harga' => 8000, 'status' => 'aktif'],
            ['nama' => 'Kopi Susu Gula Aren', 'kategori' => 'minuman', 'harga' => 15000, 'status' => 'aktif'],
            ['nama' => 'Jus Alpukat', 'kategori' => 'minuman', 'harga' => 18000, 'status' => 'aktif'],
            ['nama' => 'Jus Jeruk Peras', 'kategori' => 'minuman', 'harga' => 12000, 'status' => 'aktif'],
            ['nama' => 'Es Lemon Tea', 'kategori' => 'minuman', 'harga' => 10000, 'status' => 'aktif'],
            ['nama' => 'Pisang Goreng Keju', 'kategori' => 'cemilan', 'harga' => 15000, 'status' => 'aktif'],
            ['nama' => 'Roti Bakar Coklat Keju', 'kategori' => 'cemilan', 'harga' => 18000, 'status' => 'aktif'],
            ['nama' => 'Kentang Goreng (French Fries)', 'kategori' => 'cemilan', 'harga' => 16000, 'status' => 'aktif'],
            ['nama' => 'Mendoan Hangat (Isi 5)', 'kategori' => 'cemilan', 'harga' => 12000, 'status' => 'aktif'],
        ];

        foreach ($menus as $menu) {
            Menu::create($menu);
        }
    }
}
