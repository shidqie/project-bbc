<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;
use App\Models\BahanBaku;
use App\Models\Menu;
use App\Models\Supplier;
use App\Models\Pelanggan;
use App\Models\PaketCatering;
use App\Models\PaketNasibox;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Data Meja
        Meja::create(['nomor' => '1', 'kapasitas' => 4, 'status' => 'tersedia']);
        Meja::create(['nomor' => '2', 'kapasitas' => 2, 'status' => 'tersedia']);
        Meja::create(['nomor' => '3', 'kapasitas' => 6, 'status' => 'tersedia']);
        Meja::create(['nomor' => 'VIP 1', 'kapasitas' => 10, 'status' => 'tersedia']);

        // 2. Data Bahan Baku
        $beras = BahanBaku::create(['nama' => 'Beras Putih', 'satuan' => 'Gram', 'stok' => 50000, 'batas_minimum' => 5000]);
        $ayam = BahanBaku::create(['nama' => 'Ayam Potong', 'satuan' => 'Pcs', 'stok' => 100, 'batas_minimum' => 20]);
        $minyak = BahanBaku::create(['nama' => 'Minyak Goreng', 'satuan' => 'Mililiter', 'stok' => 10000, 'batas_minimum' => 2000]);
        $teh = BahanBaku::create(['nama' => 'Teh Celup', 'satuan' => 'Pcs', 'stok' => 200, 'batas_minimum' => 50]);
        $gula = BahanBaku::create(['nama' => 'Gula Pasir', 'satuan' => 'Gram', 'stok' => 10000, 'batas_minimum' => 1000]);

        // 3. Data Menu
        $nasiAyam = Menu::create([
            'nama' => 'Nasi Ayam Goreng Spesial',
            'harga' => 25000,
            'kategori' => 'makanan',
            'status' => 'aktif'
        ]);
        
        $esTeh = Menu::create([
            'nama' => 'Es Teh Manis',
            'harga' => 5000,
            'kategori' => 'minuman',
            'status' => 'aktif'
        ]);

        // 4. Komposisi Menu (BOM)
        $nasiAyam->komposisi()->createMany([
            ['bahan_baku_id' => $beras->id, 'jumlah_kebutuhan' => 150], // 150 gr beras
            ['bahan_baku_id' => $ayam->id, 'jumlah_kebutuhan' => 1],    // 1 potong ayam
            ['bahan_baku_id' => $minyak->id, 'jumlah_kebutuhan' => 50]  // 50 ml minyak
        ]);

        $esTeh->komposisi()->createMany([
            ['bahan_baku_id' => $teh->id, 'jumlah_kebutuhan' => 1],     // 1 kantong teh
            ['bahan_baku_id' => $gula->id, 'jumlah_kebutuhan' => 20]    // 20 gr gula
        ]);

        // 5. Data Pelanggan
        Pelanggan::create([
            'nama' => 'Bapak Budi',
            'no_hp' => '081234567890',
            'alamat' => 'Jl. Merdeka No. 1'
        ]);

        Pelanggan::create([
            'nama' => 'Ibu Siti',
            'no_hp' => '089876543210',
            'alamat' => 'Jl. Jenderal Sudirman No. 45'
        ]);

        // 6. Data Supplier
        Supplier::create([
            'nama' => 'Toko Sembako Makmur',
            'no_hp' => '082111222333',
            'alamat' => 'Pasar Induk Blok A'
        ]);

        // 7. Data Paket Catering
        $paketCatering = PaketCatering::create([
            'nama' => 'Paket Syukuran',
            'deskripsi' => 'Paket hemat untuk acara tasyakuran keluarga.',
            'harga' => 30000,
            'minimum_order' => 50
        ]);
        
        // Komposisi Paket
        $paketCatering->detail()->createMany([
            ['menu_id' => $nasiAyam->id, 'jumlah_porsi' => 1],
            ['menu_id' => $esTeh->id, 'jumlah_porsi' => 1]
        ]);

        // 8. Data Paket Nasi Box
        $paketNasibox = PaketNasibox::create([
            'nama' => 'Nasi Box Hemat',
            'deskripsi' => 'Nasi box praktis untuk seminar.',
            'harga' => 28000
        ]);
        
        $paketNasibox->detail()->createMany([
            ['menu_id' => $nasiAyam->id, 'jumlah_porsi' => 1]
        ]);
    }
}
