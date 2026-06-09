<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Tambah Paket Catering') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('paket-catering.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="nama" class="block font-medium text-sm text-gray-700">Nama Paket</label>
                                    <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                </div>

                                <div>
                                    <label for="deskripsi" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                                    <textarea name="deskripsi" id="deskripsi" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm"></textarea>
                                </div>

                                <div>
                                    <label for="harga" class="block font-medium text-sm text-gray-700">Harga (Rp)</label>
                                    <input type="number" name="harga" id="harga" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                </div>

                                <div>
                                    <label for="minimum_order" class="block font-medium text-sm text-gray-700">Minimum Order (Porsi)</label>
                                    <input type="number" name="minimum_order" id="minimum_order" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="10" required>
                                </div>

                                <div>
                                    <label for="gambar" class="block font-medium text-sm text-gray-700">Gambar Paket</label>
                                    <input type="file" name="gambar" id="gambar" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div>
                                    <h4 class="font-medium text-sm text-gray-700 border-b pb-2 mb-4">Pilih Menu (Isian Paket)</h4>
                                    <div id="bom-container" class="space-y-3">
                                        <div class="flex gap-2 bom-row">
                                            <select name="menu_id[]" class="block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" required>
                                                <option value="">-- Pilih Menu --</option>
                                                @foreach($menus as $menu)
                                                    <option value="{{ $menu->id }}">{{ $menu->nama }}</option>
                                                @endforeach
                                            </select>
                                            <input type="number" name="jumlah_porsi[]" placeholder="Porsi" class="block w-24 border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" min="1" value="1" required>
                                            <button type="button" class="px-2 py-1 bg-red-100 text-red-600 rounded-[4px] hover:bg-red-200" onclick="this.parentElement.remove()">X</button>
                                        </div>
                                    </div>
                                    <button type="button" onclick="addBomRow()" class="mt-3 text-sm text-[#3B82F6] hover:underline font-medium">+ Tambah Menu</button>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Simpan Data
                            </button>
                            <a href="{{ route('paket-catering.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
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
            row.querySelector('input').value = '1';
            container.appendChild(row);
        }
    </script>
</x-app-layout>
