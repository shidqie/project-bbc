<?php

namespace App\Http\Controllers;

use App\Models\Pengadaan;
use App\Models\Supplier;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PengadaanController extends Controller
{
    public function index()
    {
        $pengadaans = Pengadaan::with(['supplier', 'user'])->latest()->paginate(10);
        return view('pengadaan.index', compact('pengadaans'));
    }

    public function create()
    {
        $suppliers = Supplier::all();
        $bahanBakus = BahanBaku::all();
        return view('pengadaan.create', compact('suppliers', 'bahanBakus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'tanggal' => 'required|date',
            'bahan_baku_id' => 'required|array',
            'bahan_baku_id.*' => 'exists:bahan_bakus,id',
            'qty' => 'required|array',
            'harga_satuan' => 'required|array',
            'status' => 'required|in:draft,selesai'
        ]);

        DB::beginTransaction();
        try {
            $totalBiaya = 0;
            $items = [];

            foreach ($request->bahan_baku_id as $index => $bb_id) {
                if (!empty($request->qty[$index]) && !empty($request->harga_satuan[$index])) {
                    $subtotal = $request->qty[$index] * $request->harga_satuan[$index];
                    $totalBiaya += $subtotal;
                    $items[] = [
                        'bahan_baku_id' => $bb_id,
                        'qty' => $request->qty[$index],
                        'harga_satuan' => $request->harga_satuan[$index],
                        'subtotal' => $subtotal,
                    ];
                }
            }

            if (empty($items)) {
                return back()->with('error', 'Minimal satu bahan baku harus diisi.');
            }

            $pengadaan = Pengadaan::create([
                'supplier_id' => $request->supplier_id,
                'user_id' => Auth::id(),
                'tanggal' => $request->tanggal,
                'total_biaya' => $totalBiaya,
                'status' => $request->status,
            ]);

            foreach ($items as $item) {
                $pengadaan->detail()->create($item);

                // Jika status langsung selesai, tambah stok
                if ($request->status == 'selesai') {
                    BahanBaku::where('id', $item['bahan_baku_id'])->increment('stok', $item['qty']);
                }
            }

            DB::commit();
            return redirect()->route('pengadaan.index')->with('success', 'Pengadaan berhasil dicatat.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function updateStatus(Request $request, $id)
    {
        $pengadaan = Pengadaan::with('detail')->findOrFail($id);
        
        if ($pengadaan->status == 'selesai') {
            return back()->with('error', 'Pengadaan sudah berstatus selesai dan stok sudah ditambahkan.');
        }

        DB::beginTransaction();
        try {
            $pengadaan->update(['status' => 'selesai']);

            foreach ($pengadaan->detail as $detail) {
                BahanBaku::where('id', $detail->bahan_baku_id)->increment('stok', $detail->qty);
            }

            DB::commit();
            return back()->with('success', 'Status pengadaan diubah menjadi Selesai. Stok berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pengadaan = Pengadaan::with(['supplier', 'detail.bahanBaku'])->findOrFail($id);
        return view('pengadaan.show', compact('pengadaan'));
    }

    /**
     * Export PDF Daftar Pembelian (blueprint FR-13 & FR-14)
     */
    public function exportPdf($id)
    {
        $pengadaan = Pengadaan::with(['supplier', 'detail.bahanBaku', 'user'])->findOrFail($id);
        $pdf = Pdf::loadView('pengadaan.pdf', compact('pengadaan'))
            ->setPaper('a4', 'portrait');
        return $pdf->download('pengadaan-' . str_pad($id, 4, '0', STR_PAD_LEFT) . '.pdf');
    }
}

