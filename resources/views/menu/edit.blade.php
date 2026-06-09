<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Edit Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('menu.update', $menu->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="nama" class="block font-medium text-sm text-gray-700">Nama Menu</label>
                                    <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('nama', $menu->nama) }}" required>
                                    @error('nama') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="kategori" class="block font-medium text-sm text-gray-700">Kategori</label>
                                    <select name="kategori" id="kategori" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                        <option value="makanan" {{ $menu->kategori == 'makanan' ? 'selected' : '' }}>Makanan</option>
                                        <option value="minuman" {{ $menu->kategori == 'minuman' ? 'selected' : '' }}>Minuman</option>
                                        <option value="snack" {{ $menu->kategori == 'snack' ? 'selected' : '' }}>Snack</option>
                                    </select>
                                    @error('kategori') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="harga" class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                                    <input type="number" name="harga" id="harga" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('harga', $menu->harga) }}" min="0" required>
                                    @error('harga') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                        <option value="aktif" {{ $menu->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="nonaktif" {{ $menu->status == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label for="gambar" class="block font-medium text-sm text-gray-700">Gambar Menu</label>
                                    @if($menu->gambar)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $menu->gambar) }}" class="w-32 h-32 object-cover rounded-[4px]">
                                        </div>
                                    @endif
                                    <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm">
                                    <p class="text-xs text-gray-500 mt-1">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                    @error('gambar') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-sm text-gray-700 border-b pb-2 mb-4">Komposisi Bahan Baku (BOM)</h4>
                                    <div id="bom-container" class="space-y-3">
                                        @forelse($menu->komposisi as $komp)
                                        <div class="flex gap-2 bom-row">
                                            <select name="bahan_baku[]" class="block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm">
                                                <option value="">-- Pilih Bahan --</option>
                                                @foreach($bahanBakus as $bb)
                                                    <option value="{{ $bb->id }}" {{ $komp->bahan_baku_id == $bb->id ? 'selected' : '' }}>{{ $bb->nama }} ({{ $bb->satuan }})</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="jumlah_kebutuhan[]" value="{{ $komp->jumlah_kebutuhan }}" placeholder="Qty" class="block w-24 border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" min="1">
                                            <button type="button" class="px-2 py-1 bg-red-100 text-red-600 rounded-[4px] hover:bg-red-200" onclick="this.parentElement.remove()">X</button>
                                        </div>
                                        @empty
                                        <div class="flex gap-2 bom-row">
                                            <select name="bahan_baku[]" class="block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm">
                                                <option value="">-- Pilih Bahan --</option>
                                                @foreach($bahanBakus as $bb)
                                                    <option value="{{ $bb->id }}">{{ $bb->nama }} ({{ $bb->satuan }})</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="jumlah_kebutuhan[]" placeholder="Qty" class="block w-24 border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" min="1">
                                            <button type="button" class="px-2 py-1 bg-red-100 text-red-600 rounded-[4px] hover:bg-red-200" onclick="this.parentElement.remove()">X</button>
                                        </div>
                                        @endforelse
                                    </div>
                                    <button type="button" onclick="addBomRow()" class="mt-3 text-sm text-[#3B82F6] hover:underline font-medium">+ Tambah Bahan</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Perbarui Data
                            </button>
                            <a href="{{ route('menu.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addBomRow() {
            const container = document.getElementById('bom-container');
            const row = container.children[0].cloneNode(true);
            row.querySelector('select').value = '';
            row.querySelector('input').value = '';
            container.appendChild(row);
        }
    </script>
</x-app-layout>
