<?php

namespace App\Http\Controllers;

use App\Models\PesananCatering;
use App\Models\PaketCatering;
use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananCateringController extends Controller
{
    // Status flow sesuai blueprint
    const STATUS_FLOW = [
        'menunggu_konfirmasi' => 'terkonfirmasi',
        'terkonfirmasi'       => 'diproduksi',
        'diproduksi'          => 'dikirim',
        'dikirim'             => 'selesai',
    ];

    const STATUS_LABELS = [
        'menunggu_konfirmasi' => 'Menunggu Konfirmasi',
        'terkonfirmasi'       => 'Terkonfirmasi',
        'diproduksi'          => 'Diproduksi',
        'dikirim'             => 'Dikirim',
        'selesai'             => 'Selesai',
        'dibatalkan'          => 'Dibatalkan',
    ];

    public function index()
    {
        $pesanans = PesananCatering::with(['pelanggan', 'paketCatering'])->latest()->paginate(15);
        return view('pesanan_catering.index', compact('pesanans'));
    }

    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();
        $pakets     = PaketCatering::orderBy('nama')->get();
        return view('pesanan_catering.create', compact('pelanggans', 'pakets'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id'     => 'required|exists:pelanggans,id',
            'paket_catering_id'=> 'required|exists:paket_caterings,id',
            'qty'              => 'required|integer|min:1',
            'tanggal_kirim'    => 'required|date|after_or_equal:today',
            'catatan'          => 'nullable|string|max:500',
        ]);

        $paket = PaketCatering::findOrFail($request->paket_catering_id);

        if (isset($paket->minimum_order) && $request->qty < $paket->minimum_order) {
            return back()->with('error', "Minimum order paket ini adalah {$paket->minimum_order} porsi.");
        }

        $totalHarga = $paket->harga * $request->qty;

        PesananCatering::create([
            'pelanggan_id'      => $request->pelanggan_id,
            'paket_catering_id' => $request->paket_catering_id,
            'qty'               => $request->qty,
            'tanggal_kirim'     => $request->tanggal_kirim,
            'total_harga'       => $totalHarga,
            'catatan'           => $request->catatan,
            'status'            => 'menunggu_konfirmasi',
        ]);

        return redirect()->route('pesanan-catering.index')
            ->with('success', 'Pesanan Catering berhasil dibuat.');
    }

    public function show($id)
    {
        $pesanan = PesananCatering::with(['pelanggan', 'paketCatering.detail.menu.komposisi.bahanBaku'])->findOrFail($id);
        $statusLabels = self::STATUS_LABELS;
        $statusFlow   = self::STATUS_FLOW;
        return view('pesanan_catering.show', compact('pesanan', 'statusLabels', 'statusFlow'));
    }

    public function updateStatus(Request $request, $id)
    {
        $validStatuses = array_keys(self::STATUS_LABELS);
        $request->validate([
            'status' => 'required|in:' . implode(',', $validStatuses),
        ]);

        $pesanan   = PesananCatering::findOrFail($id);
        $newStatus = $request->status;

        DB::beginTransaction();
        try {
            $pesanan->update(['status' => $newStatus]);

            // Potong stok BOM saat status → diproduksi
            if ($newStatus === 'diproduksi') {
                $paket = $pesanan->paketCatering()->with('detail.menu.komposisi.bahanBaku')->first();
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

    /**
     * Generate daftar kebutuhan bahan baku untuk pesanan catering (blueprint FR-13)
     */
    public function kebutuhanBahan($id)
    {
        $pesanan = PesananCatering::with(['pelanggan', 'paketCatering.detail.menu.komposisi.bahanBaku'])->findOrFail($id);

        $kebutuhan = collect();
        foreach ($pesanan->paketCatering->detail ?? [] as $detail) {
            foreach ($detail->menu->komposisi ?? [] as $komposisi) {
                $bahan   = $komposisi->bahanBaku;
                $jumlah  = $komposisi->jumlah_kebutuhan * ($detail->qty ?? 1) * $pesanan->qty;
                $key     = $bahan->id;
                if ($kebutuhan->has($key)) {
                    $kebutuhan[$key]['jumlah'] += $jumlah;
                } else {
                    $kebutuhan[$key] = ['nama' => $bahan->nama, 'satuan' => $bahan->satuan, 'jumlah' => $jumlah, 'stok' => $bahan->stok];
                }
            }
        }

        return view('pesanan_catering.kebutuhan_bahan', compact('pesanan', 'kebutuhan'));
    }
}
