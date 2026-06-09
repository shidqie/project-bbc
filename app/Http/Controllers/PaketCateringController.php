<?php

namespace App\Http\Controllers;

use App\Models\PaketCatering;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketCateringController extends Controller
{
    public function index()
    {
        $pakets = PaketCatering::latest()->paginate(10);
        return view('paket_catering.index', compact('pakets'));
    }

    public function create()
    {
        $menus = Menu::where('status', 'aktif')->get();
        return view('paket_catering.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'minimum_order' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menus,id',
            'jumlah_porsi' => 'required|array',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('paket_caterings', 'public');
        }

        $paket = PaketCatering::create($validated);

        if ($request->has('menu_id')) {
            foreach ($request->menu_id as $index => $m_id) {
                if (!empty($request->jumlah_porsi[$index])) {
                    $paket->detail()->create([
                        'menu_id' => $m_id,
                        'jumlah_porsi' => $request->jumlah_porsi[$index],
                    ]);
                }
            }
        }

        return redirect()->route('paket-catering.index')->with('success', 'Paket Catering berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PaketCatering $paketCatering)
    {
        $menus = Menu::where('status', 'aktif')->get();
        $paketCatering->load('detail');
        return view('paket_catering.edit', compact('paketCatering', 'menus'));
    }

    public function update(Request $request, PaketCatering $paketCatering)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'minimum_order' => 'required|integer|min:1',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menus,id',
            'jumlah_porsi' => 'required|array',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paketCatering->gambar) {
                Storage::disk('public')->delete($paketCatering->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('paket_caterings', 'public');
        }

        $paketCatering->update($validated);

        $paketCatering->detail()->delete();
        if ($request->has('menu_id')) {
            foreach ($request->menu_id as $index => $m_id) {
                if (!empty($request->jumlah_porsi[$index])) {
                    $paketCatering->detail()->create([
                        'menu_id' => $m_id,
                        'jumlah_porsi' => $request->jumlah_porsi[$index],
                    ]);
                }
            }
        }

        return redirect()->route('paket-catering.index')->with('success', 'Paket Catering berhasil diperbarui.');
    }

    public function destroy(PaketCatering $paketCatering)
    {
        if ($paketCatering->gambar) {
            Storage::disk('public')->delete($paketCatering->gambar);
        }
        $paketCatering->delete();
        return redirect()->route('paket-catering.index')->with('success', 'Paket Catering berhasil dihapus.');
    }
}
