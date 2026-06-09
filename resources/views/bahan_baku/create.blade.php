<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Tambah Bahan Baku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('bahan-baku.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama Bahan</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('nama') }}" required>
                            @error('nama') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label for="satuan" class="block font-medium text-sm text-gray-700">Satuan</label>
                            <input type="text" name="satuan" id="satuan" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('satuan') }}" placeholder="Contoh: kg, gram, pcs" required>
                            @error('satuan') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="stok" class="block font-medium text-sm text-gray-700">Stok Awal</label>
                                <input type="number" name="stok" id="stok" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('stok', 0) }}" min="0" required>
                                @error('stok') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="batas_minimum" class="block font-medium text-sm text-gray-700">Batas Minimum</label>
                                <input type="number" name="batas_minimum" id="batas_minimum" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ old('batas_minimum', 0) }}" min="0" required>
                                @error('batas_minimum') <span class="text-[#DC2626] text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Simpan Data
                            </button>
                            <a href="{{ route('bahan-baku.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
