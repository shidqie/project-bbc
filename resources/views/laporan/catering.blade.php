@php
// shared macro for laporan table views
$lapFilterRoute = $lapFilterRoute ?? request()->route()->getName();
@endphp
<x-app-layout>
    <x-slot name="header">Laporan Catering</x-slot>
    <h4 class="fw-bold mb-3">Laporan</h4>
    @include('laporan.partials.tabs')
    <div class="card border-0 shadow-sm mb-4"><div class="card-body">
        <form method="GET" action="{{ route('laporan.catering') }}" class="row g-2 align-items-end">
            <div class="col-auto"><label class="form-label small">Dari</label><input type="date" name="start_date" value="{{ $startDate }}" class="form-control form-control-sm"></div>
            <div class="col-auto"><label class="form-label small">Sampai</label><input type="date" name="end_date" value="{{ $endDate }}" class="form-control form-control-sm"></div>
            <div class="col-auto"><button type="submit" class="btn btn-sm btn-primary">Filter</button><button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary ms-1"><i class="bi bi-printer me-1"></i>Cetak</button></div>
        </form>
    </div></div>
    <div class="row g-3 mb-4">
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Total Pesanan</p><h5 class="fw-bold mb-0">{{ $totalPesanan }}</h5></div></div></div>
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Selesai</p><h5 class="fw-bold text-success mb-0">{{ $totalSelesai }}</h5></div></div></div>
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Pendapatan</p><h6 class="fw-bold text-primary mb-0">Rp {{ number_format($totalPendapatan,0,',','.') }}</h6></div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h6 class="fw-semibold mb-0">Daftar Pesanan Catering</h6></div>
        <div class="card-body p-0"><div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr>
                    <th class="ps-4">Tanggal</th><th>Pelanggan</th><th>Paket</th><th>Qty</th><th>Status</th><th class="text-end pe-4">Total</th>
                </tr></thead>
                <tbody>
                    @forelse($pesanan as $p)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $p->created_at->format('d M Y') }}</td>
                        <td class="fw-semibold">{{ $p->pelanggan->nama ?? '-' }}</td>
                        <td>{{ $p->paketCatering->nama ?? '-' }}</td>
                        <td>{{ $p->qty }}</td>
                        <td><span class="badge bg-secondary">{{ str_replace('_',' ',ucfirst($p->status)) }}</span></td>
                        <td class="text-end pe-4 fw-bold">Rp {{ number_format($p->total_harga,0,',','.') }}</td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    </div>
</x-app-layout>
