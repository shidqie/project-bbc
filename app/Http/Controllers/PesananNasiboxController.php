<?php

namespace App\Http\Controllers;

use App\Models\PesananNasibox;
use App\Models\PaketNasibox;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananNasiboxController extends Controller
{
    const STATUS_LABELS = [
        'diproses'   => 'Diproses',
        'dikirim'    => 'Dikirim',
        'selesai'    => 'Selesai',
        'dibatalkan' => 'Dibatalkan',
    ];

    public function index()
    {
        $pesanans = PesananNasibox::with(['pelanggan', 'paketNasibox'])->latest()->paginate(15);
        return view('pesanan_nasibox.index', compact('pesanans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $pakets     = PaketNasibox::orderBy('nama')->get();
        return view('pesanan_nasibox.create', compact('pelanggans', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'    => 'required|exists:pelanggans,id',
            'paket_nasibox_id'=> 'required|exists:paket_nasiboxes,id',
            'qty'             => 'required|integer|min:1',
            'tanggal_kirim'   => 'required|date|after_or_equal:today',
            'catatan'         => 'nullable|string|max:500',
        ]);

        $paket      = PaketNasibox::findOrFail($request->paket_nasibox_id);
        $totalHarga = $paket->harga * $request->qty;

        PesananNasibox::create([
            'pelanggan_id'     => $request->pelanggan_id,
            'paket_nasibox_id' => $request->paket_nasibox_id,
            'qty'              => $request->qty,
            'tanggal_kirim'    => $request->tanggal_kirim,
            'total_harga'      => $totalHarga,
            'catatan'          => $request->catatan,
            'status'           => 'diproses',
        ]);

        return redirect()->route('pesanan-nasibox.index')
            ->with('success', 'Pesanan Nasi Box berhasil dibuat.');
    }

    public function show($id)
    {
        $pesanan = PesananNasibox::with(['pelanggan', 'paketNasibox'])->findOrFail($id);
        $statusLabels = self::STATUS_LABELS;
        return view('pesanan_nasibox.show', compact('pesanan', 'statusLabels'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:diproses,dikirim,selesai,dibatalkan',
        ]);

        $pesanan   = PesananNasibox::findOrFail($id);
        $newStatus = $request->status;

        DB::beginTransaction();
        try {
            $pesanan->update(['status' => $newStatus]);

            // Potong stok BOM saat status → dikirim
            if ($newStatus === 'dikirim') {
                $paket = $pesanan->paketNasibox()->with('detail.menu.komposisi.bahanBaku')->first();
                if ($paket && $paket->detail) {
                    foreach ($paket->detail as $detail) {
                        foreach ($detail->menu->komposisi ?? [] as $komposisi) {
                            $pengurangan = $komposisi->jumlah_kebutuhan * ($detail->qty ?? 1) * $pesanan->qty;
                            $komposisi->bahanBaku->decrement('stok', $pengurangan);
                        }
                    }
                }
            }

            DB::commit();
            return back()->with('success', 'Status pesanan berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
