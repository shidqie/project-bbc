<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransaksiDinein;
use App\Models\PesananCatering;
use App\Models\PesananNasibox;
use App\Models\BahanBaku;
use App\Models\Pengadaan;
use Carbon\Carbon;

class LaporanController extends Controller
{
    // ─── Helper ───────────────────────────────────────────────────────
    private function getDateRange(Request $request): array
    {
        $start = Carbon::parse($request->input('start_date', Carbon::now()->startOfMonth()->toDateString()))->startOfDay();
        $end   = Carbon::parse($request->input('end_date', Carbon::now()->endOfMonth()->toDateString()))->endOfDay();
        return [$start, $end, $start->toDateString(), $end->toDateString()];
    }

    // ─── 1. Laporan Penjualan (Dine-In + Catering + NasiBox) ─────────
    public function penjualan(Request $request)
    {
        [$start, $end, $startDate, $endDate] = $this->getDateRange($request);

        $dineIn  = TransaksiDinein::whereBetween('created_at', [$start, $end])->get();
        $catering = PesananCatering::where('status', 'selesai')->whereBetween('created_at', [$start, $end])->get();
        $nasibox  = PesananNasibox::where('status', 'selesai')->whereBetween('created_at', [$start, $end])->get();

        $totalDineIn   = $dineIn->sum('total_harga');
        $totalCatering = $catering->sum('total_harga');
        $totalNasibox  = $nasibox->sum('total_harga');
        $grandTotal    = $totalDineIn + $totalCatering + $totalNasibox;

        $transaksi = collect();
        foreach ($dineIn as $d) {
            $transaksi->push(['tanggal' => $d->created_at, 'jenis' => 'Dine-In', 'ref' => 'DI-'.str_pad($d->id,4,'0',STR_PAD_LEFT), 'total' => $d->total_harga]);
        }
        foreach ($catering as $c) {
            $transaksi->push(['tanggal' => $c->created_at, 'jenis' => 'Catering', 'ref' => 'CA-'.str_pad($c->id,4,'0',STR_PAD_LEFT), 'total' => $c->total_harga]);
        }
        foreach ($nasibox as $n) {
            $transaksi->push(['tanggal' => $n->created_at, 'jenis' => 'Nasi Box', 'ref' => 'NB-'.str_pad($n->id,4,'0',STR_PAD_LEFT), 'total' => $n->total_harga]);
        }
        $transaksi = $transaksi->sortByDesc('tanggal')->values();

        return view('laporan.penjualan', compact('startDate','endDate','totalDineIn','totalCatering','totalNasibox','grandTotal','transaksi'));
    }

    // ─── 2. Laporan Catering ──────────────────────────────────────────
    public function catering(Request $request)
    {
        [$start, $end, $startDate, $endDate] = $this->getDateRange($request);

        $pesanan = PesananCatering::with(['pelanggan','paketCatering'])
            ->whereBetween('created_at', [$start, $end])
            ->orderByDesc('created_at')
            ->get();

        $totalPesanan  = $pesanan->count();
        $totalSelesai  = $pesanan->where('status','selesai')->count();
        $totalPendapatan = $pesanan->where('status','selesai')->sum('total_harga');

        return view('laporan.catering', compact('startDate','endDate','pesanan','totalPesanan','totalSelesai','totalPendapatan'));
    }

    // ─── 3. Laporan Nasi Box ─────────────────────────────────────────
    public function nasibox(Request $request)
    {
        [$start, $end, $startDate, $endDate] = $this->getDateRange($request);

        $pesanan = PesananNasibox::with(['pelanggan','paketNasibox'])
            ->whereBetween('created_at', [$start, $end])
            ->orderByDesc('created_at')
            ->get();

        $totalPesanan    = $pesanan->count();
        $totalSelesai    = $pesanan->where('status','selesai')->count();
        $totalPendapatan = $pesanan->where('status','selesai')->sum('total_harga');

        return view('laporan.nasibox', compact('startDate','endDate','pesanan','totalPesanan','totalSelesai','totalPendapatan'));
    }

    // ─── 4. Laporan Persediaan (Stok Bahan Baku) ─────────────────────
    public function persediaan(Request $request)
    {
        $bahanBakus = BahanBaku::orderBy('nama')->get();
        $totalItem   = $bahanBakus->count();
        $stokNormal  = $bahanBakus->filter(fn($b) => $b->stok > $b->batas_minimum)->count();
        $stokMenipis = $bahanBakus->filter(fn($b) => $b->stok <= $b->batas_minimum)->count();

        return view('laporan.persediaan', compact('bahanBakus','totalItem','stokNormal','stokMenipis'));
    }

    // ─── 5. Laporan Pengadaan ────────────────────────────────────────
    public function pengadaan(Request $request)
    {
        [$start, $end, $startDate, $endDate] = $this->getDateRange($request);

        $pengadaans = Pengadaan::with(['supplier','detail.bahanBaku'])
            ->whereBetween('created_at', [$start, $end])
            ->orderByDesc('created_at')
            ->get();

        $totalPengadaan = $pengadaans->count();
        $totalNilai     = $pengadaans->sum(fn($p) => $p->detail->sum('subtotal'));

        return view('laporan.pengadaan', compact('startDate','endDate','pengadaans','totalPengadaan','totalNilai'));
    }
}
