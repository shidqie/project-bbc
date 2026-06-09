<x-app-layout>
    <x-slot name="header">Laporan Penjualan</x-slot>

    <!-- Filter -->
    <div class="bg-white rounded-2xl border border-[#E2E8F0] shadow-sm p-5 mb-6">
        <form method="GET" action="{{ route('laporan.index') }}" class="flex flex-col md:flex-row items-end gap-4">
            <div>
                <label class="text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="mt-1 w-full text-sm border-[#E2E8F0] focus:border-[#3B82F6] focus:ring-2 focus:ring-[#3B82F6]/20 rounded-xl">
            </div>
            <div>
                <label class="text-[10px] font-semibold text-[#94A3B8] uppercase tracking-wider">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="mt-1 w-full text-sm border-[#E2E8F0] focus:border-[#3B82F6] focus:ring-2 focus:ring-[#3B82F6]/20 rounded-xl">
            </div>
            <button type="submit" class="px-5 py-2.5 bg-[#3B82F6] hover:bg-[#2563EB] text-white text-sm font-semibold rounded-xl shadow-sm shadow-blue-500/20 transition">
                Filter
            </button>
        </form>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="relative overflow-hidden bg-gradient-to-br from-[#3B82F6] to-[#2563EB] rounded-2xl p-5 text-white shadow-lg shadow-blue-500/20">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8"></div>
            <p class="text-blue-100 text-xs font-medium mb-1">Total Penjualan</p>
            <p class="text-2xl font-extrabold">Rp {{ number_format($grandTotal, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E2E8F0] shadow-sm">
            <p class="text-[#94A3B8] text-xs font-medium mb-1">Dine-In</p>
            <p class="text-xl font-extrabold text-[#0F172A]">Rp {{ number_format($totalDineIn, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E2E8F0] shadow-sm">
            <p class="text-[#94A3B8] text-xs font-medium mb-1">Catering</p>
            <p class="text-xl font-extrabold text-[#0F172A]">Rp {{ number_format($totalCatering, 0, ',', '.') }}</p>
        </div>
        <div class="bg-white rounded-2xl p-5 border border-[#E2E8F0] shadow-sm">
            <p class="text-[#94A3B8] text-xs font-medium mb-1">Nasi Box</p>
            <p class="text-xl font-extrabold text-[#0F172A]">Rp {{ number_format($totalNasibox, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-2xl border border-[#E2E8F0] shadow-sm overflow-hidden">
        <div class="px-6 py-4 border-b border-[#F1F5F9] flex items-center justify-between">
            <h3 class="text-sm font-bold text-[#0F172A]">Rincian Transaksi</h3>
            <button onclick="window.print()" class="text-xs font-semibold px-3 py-1.5 bg-[#F1F5F9] text-[#64748B] rounded-lg hover:bg-[#E2E8F0] transition flex items-center gap-1.5">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0110.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0l.229 2.523a1.125 1.125 0 01-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0021 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 00-1.913-.247M6.34 18H5.25A2.25 2.25 0 013 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 011.913-.247m10.5 0a48.536 48.536 0 00-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5zm-3 0h.008v.008H15V10.5z"/></svg>
                Cetak
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-[#F8FAFC]">
                        <th class="text-left px-6 py-3 text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Tanggal</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">No. Ref</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Jenis</th>
                        <th class="text-left px-6 py-3 text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Metode</th>
                        <th class="text-right px-6 py-3 text-xs font-semibold text-[#94A3B8] uppercase tracking-wider">Total</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-[#F1F5F9]">
                    @forelse($semuaTransaksi as $trx)
                    <tr class="hover:bg-[#F8FAFC] transition">
                        <td class="px-6 py-3.5 text-sm text-[#64748B]">{{ \Carbon\Carbon::parse($trx['tanggal'])->format('d M Y H:i') }}</td>
                        <td class="px-6 py-3.5 text-sm font-semibold text-[#0F172A]">{{ $trx['nomor_referensi'] }}</td>
                        <td class="px-6 py-3.5">
                            <span class="text-xs font-semibold px-2.5 py-1 rounded-full 
                                {{ $trx['jenis'] == 'Dine-In' ? 'bg-blue-50 text-blue-600' : '' }}
                                {{ $trx['jenis'] == 'Catering' ? 'bg-purple-50 text-purple-600' : '' }}
                                {{ $trx['jenis'] == 'Nasi Box' ? 'bg-amber-50 text-amber-600' : '' }}">
                                {{ $trx['jenis'] }}
                            </span>
                        </td>
                        <td class="px-6 py-3.5 text-sm text-[#64748B] capitalize">{{ $trx['metode_pembayaran'] }}</td>
                        <td class="px-6 py-3.5 text-sm font-bold text-[#0F172A] text-right">Rp {{ number_format($trx['total_harga'], 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-[#94A3B8]">Tidak ada transaksi pada rentang tanggal ini.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
