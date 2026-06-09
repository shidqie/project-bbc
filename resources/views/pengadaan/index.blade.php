<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" style="font-family: 'Google Sans', sans-serif;">
            {{ __('Pengadaan (Procurement)') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-[8px]">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h3 class="text-lg font-medium" style="font-family: 'Google Sans', sans-serif;">Riwayat Pengadaan Bahan Baku</h3>
                        <a href="{{ route('pengadaan.create') }}" class="px-4 py-2 bg-[#3B82F6] hover:bg-blue-600 text-white rounded-[4px] transition ease-in-out duration-150 shadow-sm">
                            + Catat Pengadaan
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-[4px]">
                            {{ session('success') }}
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-4 p-4 text-red-700 bg-red-100 rounded-[4px]">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-gray-50 border-b">
                                    <th class="p-4 font-medium text-gray-600">ID</th>
                                    <th class="p-4 font-medium text-gray-600">Tanggal</th>
                                    <th class="p-4 font-medium text-gray-600">Supplier</th>
                                    <th class="p-4 font-medium text-gray-600">Total Biaya</th>
                                    <th class="p-4 font-medium text-gray-600">Pencatat</th>
                                    <th class="p-4 font-medium text-gray-600">Status</th>
                                    <th class="p-4 font-medium text-gray-600 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pengadaans as $item)
                                <tr class="border-b hover:bg-gray-50 transition duration-150">
                                    <td class="p-4 font-medium">#{{ $item->id }}</td>
                                    <td class="p-4">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                                    <td class="p-4 font-medium">{{ $item->supplier->nama }}</td>
                                    <td class="p-4 font-medium text-[#3B82F6]">Rp {{ number_format($item->total_biaya, 0, ',', '.') }}</td>
                                    <td class="p-4 text-sm">{{ $item->user->name }}</td>
                                    <td class="p-4">
                                        @if($item->status == 'selesai')
                                            <span class="px-2 py-1 rounded-[4px] text-xs font-medium uppercase bg-green-100 text-green-800">Selesai (Stok Masuk)</span>
                                        @else
                                            <span class="px-2 py-1 rounded-[4px] text-xs font-medium uppercase bg-yellow-100 text-yellow-800">Draft</span>
                                        @endif
                                    </td>
                                    <td class="p-4 text-right">
                                        @if($item->status == 'draft')
                                        <form action="{{ route('pengadaan.updateStatus', $item->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin barang sudah diterima dan stok akan ditambahkan?');">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-sm px-3 py-1 bg-[#16A34A] text-white rounded-[4px] hover:bg-green-600 transition">Selesaikan</button>
                                        </form>
                                        @else
                                        <span class="text-xs text-gray-400 italic">No Action</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="p-4 text-center text-gray-500">Belum ada data pengadaan.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-4">
                        {{ $pengadaans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
