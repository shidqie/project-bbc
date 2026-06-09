<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    public function index()
    {
        $mejas = Meja::latest()->paginate(10);
        return view('meja.index', compact('mejas'));
    }

    public function create()
    {
        return view('meja.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:50|unique:mejas,nomor',
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,dipesan',
        ]);
        Meja::create($validated);
        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(Meja $meja)
    {
        return view('meja.edit', compact('meja'));
    }

    public function update(Request $request, Meja $meja)
    {
        $validated = $request->validate([
            'nomor' => 'required|string|max:50|unique:mejas,nomor,'.$meja->id,
            'kapasitas' => 'required|integer|min:1',
            'status' => 'required|in:tersedia,terisi,dipesan',
        ]);
        $meja->update($validated);
        return redirect()->route('meja.index')->with('success', 'Meja berhasil diperbarui.');
    }

    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}
