<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Catat Pengadaan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-[4px]">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pengadaan.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                <label for="supplier_id" class="block font-medium text-sm text-gray-700">Supplier</label>
                                <select name="supplier_id" id="supplier_id" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="tanggal" class="block font-medium text-sm text-gray-700">Tanggal Pengadaan</label>
                                <input type="date" name="tanggal" id="tanggal" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div>
                            <h4 class="font-medium text-sm text-gray-700 border-b pb-2 mb-4 mt-6">Daftar Bahan Baku yang Dibeli</h4>
                            <div id="items-container" class="space-y-3">
                                <div class="flex gap-2 item-row">
                                    <select name="bahan_baku_id[]" class="block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" required>
                                        <option value="">-- Pilih Bahan Baku --</option>
                                        @foreach($bahanBakus as $bb)
                                            <option value="{{ $bb->id }}">{{ $bb->nama }} ({{ $bb->satuan }}) - Stok: {{ $bb->stok }}</option>
                                        @endforeach
                                    </select>
                                    <input type="number" name="qty[]" placeholder="Qty" class="block w-24 border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" min="1" required>
                                    <input type="number" name="harga_satuan[]" placeholder="Harga/Satuan" class="block w-40 border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm text-sm" min="0" required>
                                    <button type="button" class="px-2 py-1 bg-red-100 text-red-600 rounded-[4px] hover:bg-red-200" onclick="this.parentElement.remove()">X</button>
                                </div>
                            </div>
                            <button type="button" onclick="addItemRow()" class="mt-3 text-sm text-[#3B82F6] hover:underline font-medium">+ Tambah Baris Barang</button>
                        </div>

                        <div class="mt-4 border-t pt-4">
                            <label class="block font-medium text-sm text-gray-700">Status Pencatatan</label>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input type="radio" name="status" id="status_selesai" value="selesai" checked class="text-[#3B82F6] focus:ring-[#3B82F6]">
                                    <label for="status_selesai" class="ml-2 text-sm text-gray-700"><strong>Selesai</strong> - Barang sudah diterima dan stok langsung ditambahkan.</label>
                                </div>
                                <div class="flex items-center">
                                    <input type="radio" name="status" id="status_draft" value="draft" class="text-[#3B82F6] focus:ring-[#3B82F6]">
                                    <label for="status_draft" class="ml-2 text-sm text-gray-700"><strong>Draft</strong> - Barang belum diterima, stok tidak ditambah (bisa diselesaikan nanti).</label>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-6 border-t border-gray-100">
                            <button type="submit" class="px-6 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-bold transition ease-in-out duration-150">
                                Simpan Transaksi
                            </button>
                            <a href="{{ route('pengadaan.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addItemRow() {
            const container = document.getElementById('items-container');
            const row = container.children[0].cloneNode(true);
            row.querySelector('select').value = '';
            const inputs = row.querySelectorAll('input');
            inputs[0].value = ''; // qty
            inputs[1].value = ''; // harga
            container.appendChild(row);
        }
    </script>
</x-app-layout>
