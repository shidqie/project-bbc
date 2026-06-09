<?php

namespace App\Http\Controllers;

use App\Models\PaketNasibox;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaketNasiboxController extends Controller
{
    public function index()
    {
        $pakets = PaketNasibox::latest()->paginate(10);
        return view('paket_nasibox.index', compact('pakets'));
    }

    public function create()
    {
        $menus = Menu::where('status', 'aktif')->get();
        return view('paket_nasibox.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menus,id',
            'jumlah_porsi' => 'required|array',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('paket_nasiboxes', 'public');
        }

        $paket = PaketNasibox::create($validated);

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

        return redirect()->route('paket-nasibox.index')->with('success', 'Paket Nasi Box berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(PaketNasibox $paketNasibox)
    {
        $menus = Menu::where('status', 'aktif')->get();
        $paketNasibox->load('detail');
        return view('paket_nasibox.edit', compact('paketNasibox', 'menus'));
    }

    public function update(Request $request, PaketNasibox $paketNasibox)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'harga' => 'required|integer|min:0',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'menu_id' => 'required|array',
            'menu_id.*' => 'exists:menus,id',
            'jumlah_porsi' => 'required|array',
        ]);

        if ($request->hasFile('gambar')) {
            if ($paketNasibox->gambar) {
                Storage::disk('public')->delete($paketNasibox->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('paket_nasiboxes', 'public');
        }

        $paketNasibox->update($validated);

        $paketNasibox->detail()->delete();
        if ($request->has('menu_id')) {
            foreach ($request->menu_id as $index => $m_id) {
                if (!empty($request->jumlah_porsi[$index])) {
                    $paketNasibox->detail()->create([
                        'menu_id' => $m_id,
                        'jumlah_porsi' => $request->jumlah_porsi[$index],
                    ]);
                }
            }
        }

        return redirect()->route('paket-nasibox.index')->with('success', 'Paket Nasi Box berhasil diperbarui.');
    }

    public function destroy(PaketNasibox $paketNasibox)
    {
        if ($paketNasibox->gambar) {
            Storage::disk('public')->delete($paketNasibox->gambar);
        }
        $paketNasibox->delete();
        return redirect()->route('paket-nasibox.index')->with('success', 'Paket Nasi Box berhasil dihapus.');
    }
}
