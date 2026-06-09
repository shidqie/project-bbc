<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Data Bahan Baku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium" style="font-family: 'Google Sans', sans-serif;">Daftar Bahan Baku</h3>
                        <a href="{{ route('bahan-baku.create') }}" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] transition ease-in-out duration-150 shadow-sm">
                            + Tambah Data
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-[4px]">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-4 font-medium text-gray-600">ID</th>
                                    <th class="p-4 font-medium text-gray-600">Nama Bahan</th>
                                    <th class="p-4 font-medium text-gray-600">Satuan</th>
                                    <th class="p-4 font-medium text-gray-600">Stok</th>
                                    <th class="p-4 font-medium text-gray-600">Batas Min.</th>
                                    <th class="p-4 font-medium text-gray-600 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($bahanBakus as $item)
                                <tr class="border-b hover:bg-gray-50 transition duration-150">
                                    <td class="p-4">{{ $item->id }}</td>
                                    <td class="p-4 font-medium">{{ $item->nama }}</td>
                                    <td class="p-4">{{ $item->satuan }}</td>
                                    <td class="p-4">
                                        <span class="px-2 py-1 rounded-[4px] text-sm {{ $item->stok <= $item->batas_minimum ? 'bg-[#DC2626] text-white' : 'bg-[#16A34A] text-white' }}">
                                            {{ $item->stok }}
                                        </span>
                                    </td>
                                    <td class="p-4">{{ $item->batas_minimum }}</td>
                                    <td class="p-4 text-right space-x-2">
                                        <a href="{{ route('bahan-baku.edit', $item->id) }}" class="text-[#8B5CF6] hover:text-purple-700 font-medium">Edit</a>
                                        <form action="{{ route('bahan-baku.destroy', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-[#DC2626] hover:text-red-700 font-medium">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="p-4 text-center text-gray-500">Belum ada data bahan baku.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $bahanBakus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
