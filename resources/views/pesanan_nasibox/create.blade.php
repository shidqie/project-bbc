<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Buat Pesanan Nasi Box') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    
                    @if(session('error'))
                        <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-[4px]">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('pesanan-nasibox.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="pelanggan_id" class="block font-medium text-sm text-gray-700">Pelanggan</label>
                            <select name="pelanggan_id" id="pelanggan_id" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($pelanggans as $pelanggan)
                                    <option value="{{ $pelanggan->id }}">{{ $pelanggan->nama }} ({{ $pelanggan->no_hp }})</option>
                                @endforeach
                            </select>
                            <p class="text-xs mt-1 text-gray-500">Belum ada? Tambahkan di menu Pelanggan terlebih dahulu.</p>
                        </div>

                        <div>
                            <label for="paket_nasibox_id" class="block font-medium text-sm text-gray-700">Paket Nasi Box</label>
                            <select name="paket_nasibox_id" id="paket_nasibox_id" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                <option value="">-- Pilih Paket --</option>
                                @foreach($pakets as $paket)
                                    <option value="{{ $paket->id }}" data-harga="{{ $paket->harga }}">{{ $paket->nama }} - Rp {{ number_format($paket->harga, 0, ',', '.') }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="qty" class="block font-medium text-sm text-gray-700">Jumlah Pesanan (Porsi/Box)</label>
                                <input type="number" name="qty" id="qty" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="1" min="1" required>
                            </div>

                            <div>
                                <label for="tanggal_kirim" class="block font-medium text-sm text-gray-700">Tanggal Kirim/Acara</label>
                                <input type="date" name="tanggal_kirim" id="tanggal_kirim" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                            </div>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Buat Pesanan
                            </button>
                            <a href="{{ route('pesanan-nasibox.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
