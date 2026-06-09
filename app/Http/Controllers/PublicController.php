<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\PaketCatering;
use App\Models\PaketNasibox;
use App\Models\Pelanggan;
use App\Models\PesananCatering;
use App\Models\PesananNasibox;

class PublicController extends Controller
{
    // ─── Home ─────────────────────────────────────────────────────────────────
    public function home()
    {
        $paketCaterings = PaketCatering::orderBy('harga')->limit(3)->get();
        $paketNasiboxes = PaketNasibox::orderBy('harga')->limit(3)->get();
        return view('public.home', compact('paketCaterings', 'paketNasiboxes'));
    }

    // ─── Tentang ──────────────────────────────────────────────────────────────
    public function about()
    {
        return view('public.about');
    }

    // ─── Menu ─────────────────────────────────────────────────────────────────
    public function menus(Request $request)
    {
        $query    = Menu::where('status', 'aktif');
        $kategori = $request->get('kategori', 'semua');
        if ($kategori !== 'semua') {
            $query->where('kategori', $kategori);
        }
        $menus = $query->get();
        return view('public.menus', compact('menus', 'kategori'));
    }

    // ─── Catering ─────────────────────────────────────────────────────────────
    public function cateringIndex()
    {
        $pakets = PaketCatering::all();
        return view('public.catering.index', compact('pakets'));
    }

    public function cateringShow($id)
    {
        $paket = PaketCatering::with('detail.menu')->findOrFail($id);
        return view('public.catering.show', compact('paket'));
    }

    // ─── Nasi Box ─────────────────────────────────────────────────────────────
    public function nasiboxIndex()
    {
        $pakets = PaketNasibox::all();
        return view('public.nasibox.index', compact('pakets'));
    }

    public function nasiboxShow($id)
    {
        $paket = PaketNasibox::with('detail.menu')->findOrFail($id);
        return view('public.nasibox.show', compact('paket'));
    }

    // ─── Order Catering ───────────────────────────────────────────────────────
    public function orderCateringForm(Request $request)
    {
        $pakets     = PaketCatering::all();
        $selectedId = $request->get('paket_id');
        return view('public.order.catering', compact('pakets', 'selectedId'));
    }

    public function orderCateringStore(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:100',
            'telepon'          => 'required|string|max:20',
            'alamat'           => 'required|string|max:255',
            'tanggal_acara'    => 'required|date|after_or_equal:today',
            'lokasi_acara'     => 'required|string|max:255',
            'paket_catering_id'=> 'required|exists:paket_caterings,id',
            'qty'              => 'required|integer|min:1',
            'catatan'          => 'nullable|string|max:500',
        ]);

        // Cari / buat pelanggan berdasarkan no_hp
        $pelanggan = Pelanggan::firstOrCreate(
            ['no_hp' => $request->telepon],
            ['nama' => $request->nama, 'alamat' => $request->alamat]
        );

        $paket      = PaketCatering::findOrFail($request->paket_catering_id);
        if (isset($paket->minimum_order) && $request->qty < $paket->minimum_order) {
            return back()->with('error', "Minimum order paket ini {$paket->minimum_order} porsi.")->withInput();
        }

        $pesanan = PesananCatering::create([
            'pelanggan_id'      => $pelanggan->id,
            'paket_catering_id' => $request->paket_catering_id,
            'qty'               => $request->qty,
            'tanggal_kirim'     => $request->tanggal_acara,
            'total_harga'       => $paket->harga * $request->qty,
            'catatan'           => $request->catatan ?? $request->lokasi_acara,
            'status'            => 'menunggu_konfirmasi',
        ]);

        return redirect()->route('public.tracking')
            ->with('success', "Pesanan catering berhasil! Nomor: CA-" . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT));
    }

    // ─── Order Nasi Box ───────────────────────────────────────────────────────
    public function orderNasiboxForm(Request $request)
    {
        $pakets     = PaketNasibox::all();
        $selectedId = $request->get('paket_id');
        return view('public.order.nasibox', compact('pakets', 'selectedId'));
    }

    public function orderNasiboxStore(Request $request)
    {
        $request->validate([
            'nama'            => 'required|string|max:100',
            'telepon'         => 'required|string|max:20',
            'alamat'          => 'required|string|max:255',
            'paket_nasibox_id'=> 'required|exists:paket_nasiboxes,id',
            'qty'             => 'required|integer|min:1',
            'tanggal_kirim'   => 'required|date|after_or_equal:today',
            'catatan'         => 'nullable|string|max:500',
        ]);

        $pelanggan = Pelanggan::firstOrCreate(
            ['no_hp' => $request->telepon],
            ['nama' => $request->nama, 'alamat' => $request->alamat]
        );

        $paket   = PaketNasibox::findOrFail($request->paket_nasibox_id);
        $pesanan = PesananNasibox::create([
            'pelanggan_id'     => $pelanggan->id,
            'paket_nasibox_id' => $request->paket_nasibox_id,
            'qty'              => $request->qty,
            'tanggal_kirim'    => $request->tanggal_kirim,
            'total_harga'      => $paket->harga * $request->qty,
            'catatan'          => $request->catatan,
            'status'           => 'diproses',
        ]);

        return redirect()->route('public.tracking')
            ->with('success', "Pesanan nasi box berhasil! Nomor: NB-" . str_pad($pesanan->id, 4, '0', STR_PAD_LEFT));
    }

    // ─── Tracking ─────────────────────────────────────────────────────────────
    public function tracking(Request $request)
    {
        $nomorPesanan = $request->get('nomor');
        $pesanan      = null;
        $jenis        = null;

        if ($nomorPesanan) {
            // Format: CA-0001 atau NB-0001
            if (str_starts_with(strtoupper($nomorPesanan), 'CA-')) {
                $id      = (int) substr($nomorPesanan, 3);
                $pesanan = PesananCatering::with('pelanggan', 'paketCatering')->find($id);
                $jenis   = 'catering';
            } elseif (str_starts_with(strtoupper($nomorPesanan), 'NB-')) {
                $id      = (int) substr($nomorPesanan, 3);
                $pesanan = PesananNasibox::with('pelanggan', 'paketNasibox')->find($id);
                $jenis   = 'nasibox';
            }
        }

        return view('public.tracking', compact('pesanan', 'jenis', 'nomorPesanan'));
    }

    // ─── Kontak ───────────────────────────────────────────────────────────────
    public function contact()
    {
        return view('public.contact');
    }
}
