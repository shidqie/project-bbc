<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Edit Meja') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('meja.update', $meja->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div>
                            <label for="nomor" class="block font-medium text-sm text-gray-700">Nomor Meja</label>
                            <input type="text" name="nomor" id="nomor" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ $meja->nomor }}" required>
                        </div>

                        <div>
                            <label for="kapasitas" class="block font-medium text-sm text-gray-700">Kapasitas (Orang)</label>
                            <input type="number" name="kapasitas" id="kapasitas" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" value="{{ $meja->kapasitas }}" min="1" required>
                        </div>

                        <div>
                            <label for="status" class="block font-medium text-sm text-gray-700">Status</label>
                            <select name="status" id="status" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                                <option value="tersedia" {{ $meja->status == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                <option value="terisi" {{ $meja->status == 'terisi' ? 'selected' : '' }}>Terisi</option>
                                <option value="dipesan" {{ $meja->status == 'dipesan' ? 'selected' : '' }}>Dipesan</option>
                            </select>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Perbarui Data
                            </button>
                            <a href="{{ route('meja.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
