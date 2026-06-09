<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::latest()->paginate(10);
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        $bahanBakus = BahanBaku::all();
        return view('menu.create', compact('bahanBakus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|in:makanan,minuman,snack',
            'harga' => 'required|integer|min:0',
            'status' => 'required|string|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bahan_baku' => 'nullable|array',
            'bahan_baku.*' => 'exists:bahan_bakus,id',
            'jumlah_kebutuhan' => 'nullable|array',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu = Menu::create($validated);

        if ($request->has('bahan_baku')) {
            foreach ($request->bahan_baku as $index => $bahan_id) {
                if (!empty($request->jumlah_kebutuhan[$index])) {
                    $menu->komposisi()->create([
                        'bahan_baku_id' => $bahan_id,
                        'jumlah_kebutuhan' => $request->jumlah_kebutuhan[$index],
                    ]);
                }
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu)
    {
        $bahanBakus = BahanBaku::all();
        $menu->load('komposisi');
        return view('menu.edit', compact('menu', 'bahanBakus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kategori' => 'required|string|in:makanan,minuman,snack',
            'harga' => 'required|integer|min:0',
            'status' => 'required|string|in:aktif,nonaktif',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'bahan_baku' => 'nullable|array',
            'bahan_baku.*' => 'exists:bahan_bakus,id',
            'jumlah_kebutuhan' => 'nullable|array',
        ]);

        if ($request->hasFile('gambar')) {
            if ($menu->gambar) {
                Storage::disk('public')->delete($menu->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('menus', 'public');
        }

        $menu->update($validated);

        $menu->komposisi()->delete();
        if ($request->has('bahan_baku')) {
            foreach ($request->bahan_baku as $index => $bahan_id) {
                if (!empty($request->jumlah_kebutuhan[$index])) {
                    $menu->komposisi()->create([
                        'bahan_baku_id' => $bahan_id,
                        'jumlah_kebutuhan' => $request->jumlah_kebutuhan[$index],
                    ]);
                }
            }
        }

        return redirect()->route('menu.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu)
    {
        if ($menu->gambar) {
            Storage::disk('public')->delete($menu->gambar);
        }
        $menu->delete();
        return redirect()->route('menu.index')->with('success', 'Menu berhasil dihapus.');
    }
}
