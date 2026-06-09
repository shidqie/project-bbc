<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDinein;
use App\Models\PesananCatering;
use App\Models\PesananNasibox;
use App\Models\BahanBaku;
use App\Models\DetailTransaksiDinein;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = Carbon::today();

        // 1. Total Pemasukan Hari Ini
        $pemasukanDinein   = TransaksiDinein::whereDate('created_at', $today)->sum('total_harga');
        $pemasukanCatering = PesananCatering::whereDate('created_at', $today)->where('status', 'selesai')->sum('total_harga');
        $pemasukanNasibox  = PesananNasibox::whereDate('created_at', $today)->where('status', 'selesai')->sum('total_harga');
        $totalPemasukan    = $pemasukanDinein + $pemasukanCatering + $pemasukanNasibox;

        // 2. Total Transaksi Hari Ini
        $totalTransaksi = TransaksiDinein::whereDate('created_at', $today)->count();

        // 3. Catering Aktif
        $cateringAktif = PesananCatering::whereIn('status', [
            'menunggu_konfirmasi', 'terkonfirmasi', 'diproduksi'
        ])->count();

        // 4. Nasi Box Aktif
        $nasiboxAktif = PesananNasibox::whereIn('status', ['diproses'])->count();

        // 5. Produk Terlaris (top 5, 30 hari terakhir)
        $produkTerlaris = DB::table('detail_transaksi_dineins')
            ->join('menus', 'detail_transaksi_dineins.menu_id', '=', 'menus.id')
            ->join('transaksi_dineins', 'detail_transaksi_dineins.transaksi_dinein_id', '=', 'transaksi_dineins.id')
            ->where('transaksi_dineins.created_at', '>=', Carbon::now()->subDays(30))
            ->select('menus.nama', DB::raw('SUM(detail_transaksi_dineins.qty) as total_terjual'))
            ->groupBy('menus.id', 'menus.nama')
            ->orderByDesc('total_terjual')
            ->limit(5)
            ->get();

        // 6. Stok Menipis
        $stokMenipis = BahanBaku::whereRaw('stok <= batas_minimum')->get();

        // 7. Data grafik penjualan 7 hari terakhir (untuk ChartJS)
        $grafikData = collect(range(6, 0))->map(function ($daysAgo) {
            $date = Carbon::today()->subDays($daysAgo);
            return [
                'label' => $date->translatedFormat('D d/m'),
                'nilai' => TransaksiDinein::whereDate('created_at', $date)->sum('total_harga'),
            ];
        });

        return view('dashboard', compact(
            'totalPemasukan',
            'totalTransaksi',
            'cateringAktif',
            'nasiboxAktif',
            'produkTerlaris',
            'stokMenipis',
            'grafikData'
        ));
    }
}
