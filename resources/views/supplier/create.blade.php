<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Tambah Supplier') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('supplier.store') }}" method="POST" class="space-y-6">
                        @csrf
                        
                        <div>
                            <label for="nama" class="block font-medium text-sm text-gray-700">Nama Supplier</label>
                            <input type="text" name="nama" id="nama" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                        </div>

                        <div>
                            <label for="no_hp" class="block font-medium text-sm text-gray-700">Nomor Handphone</label>
                            <input type="text" name="no_hp" id="no_hp" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required>
                        </div>

                        <div>
                            <label for="alamat" class="block font-medium text-sm text-gray-700">Alamat</label>
                            <textarea name="alamat" id="alamat" rows="3" class="mt-1 block w-full border-gray-300 focus:border-[#3B82F6] focus:ring-[#3B82F6] rounded-[4px] shadow-sm" required></textarea>
                        </div>

                        <div class="flex items-center gap-4 pt-4 border-t border-gray-100">
                            <button type="submit" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] font-medium transition ease-in-out duration-150">
                                Simpan Data
                            </button>
                            <a href="{{ route('supplier.index') }}" class="text-gray-500 hover:text-gray-700 font-medium">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
