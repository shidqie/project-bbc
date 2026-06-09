<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\TransaksiDinein;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PosController extends Controller
{
    public function index()
    {
        $menus = Menu::where('status', 'aktif')->get();
        // Hanya tampilkan meja yang tersedia
        $mejas = Meja::where('status', 'tersedia')->get();
        
        return view('pos.index', compact('menus', 'mejas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'meja_id' => 'required|exists:mejas,id',
            'menu_id' => 'required|array',
            'qty' => 'required|array',
            'metode_pembayaran' => 'required|in:tunai,transfer',
            'jumlah_bayar' => 'required|integer',
        ]);

        // Hitung total harga
        $totalHarga = 0;
        $items = [];
        foreach ($request->menu_id as $index => $id) {
            $menu = Menu::find($id);
            if ($menu && $request->qty[$index] > 0) {
                $subtotal = $menu->harga * $request->qty[$index];
                $totalHarga += $subtotal;
                $items[] = [
                    'menu_id' => $menu->id,
                    'qty' => $request->qty[$index],
                    'harga_satuan' => $menu->harga,
                    'subtotal' => $subtotal,
                ];
            }
        }

        if (empty($items)) {
            return back()->with('error', 'Keranjang kosong!');
        }

        if ($request->jumlah_bayar < $totalHarga) {
            return back()->with('error', 'Jumlah bayar kurang dari total harga!');
        }

        DB::beginTransaction();
        try {
            // 1. Buat transaksi
            $transaksi = TransaksiDinein::create([
                'user_id' => Auth::id(),
                'meja_id' => $request->meja_id,
                'total_harga' => $totalHarga,
                'status_pembayaran' => 'lunas',
            ]);

            // 2. Buat detail transaksi & kurangi stok bahan baku (BOM)
            foreach ($items as $item) {
                $transaksi->detail()->create($item);

                // Potong stok (BOM)
                $menu = Menu::with('komposisi.bahanBaku')->find($item['menu_id']);
                foreach ($menu->komposisi as $komposisi) {
                    $bahan = $komposisi->bahanBaku;
                    $pengurangan = $komposisi->jumlah_kebutuhan * $item['qty'];
                    $bahan->decrement('stok', $pengurangan);
                }
            }

            // 3. Catat pembayaran
            $transaksi->pembayaran()->create([
                'metode' => $request->metode_pembayaran,
                'jumlah_bayar' => $request->jumlah_bayar,
                'kembalian' => $request->jumlah_bayar - $totalHarga,
            ]);

            // 4. Update status meja
            $meja = Meja::find($request->meja_id);
            $meja->update(['status' => 'terisi']);

            DB::commit();

            return redirect()->route('pos.receipt', $transaksi->id);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function receipt($id)
    {
        $transaksi = TransaksiDinein::with(['detail.menu', 'pembayaran', 'meja', 'user'])->findOrFail($id);
        return view('pos.receipt', compact('transaksi'));
    }
}
