<x-app-layout>
    <x-slot name="header">Laporan Pengadaan</x-slot>
    <h4 class="fw-bold mb-3">Laporan</h4>
    @include('laporan.partials.tabs')
    <div class="card border-0 shadow-sm mb-4"><div class="card-body">
        <form method="GET" action="{{ route('laporan.pengadaan') }}" class="row g-2 align-items-end">
            <div class="col-auto"><label class="form-label small">Dari</label><input type="date" name="start_date" value="{{ $startDate }}" class="form-control form-control-sm"></div>
            <div class="col-auto"><label class="form-label small">Sampai</label><input type="date" name="end_date" value="{{ $endDate }}" class="form-control form-control-sm"></div>
            <div class="col-auto"><button type="submit" class="btn btn-sm btn-primary">Filter</button><button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary ms-1"><i class="bi bi-printer me-1"></i>Cetak</button></div>
        </form>
    </div></div>
    <div class="row g-3 mb-4">
        <div class="col-6"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Total Pengadaan</p><h5 class="fw-bold mb-0">{{ $totalPengadaan }}</h5></div></div></div>
        <div class="col-6"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Total Nilai</p><h6 class="fw-bold text-primary mb-0">Rp {{ number_format($totalNilai,0,',','.') }}</h6></div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h6 class="fw-semibold mb-0">Riwayat Pengadaan</h6></div>
        <div class="card-body p-0"><div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr>
                    <th class="ps-4">Tanggal</th><th>No. PO</th><th>Supplier</th><th>Status</th><th class="text-end">Nilai</th><th class="text-end pe-4">PDF</th>
                </tr></thead>
                <tbody>
                    @forelse($pengadaans as $p)
                    <tr>
                        <td class="ps-4 text-muted small">{{ $p->created_at->format('d M Y') }}</td>
                        <td class="fw-semibold">PO-{{ str_pad($p->id,4,'0',STR_PAD_LEFT) }}</td>
                        <td>{{ $p->supplier->nama ?? '-' }}</td>
                        <td><span class="badge {{ $p->status==='selesai'?'bg-success':'bg-warning text-dark' }}">{{ ucfirst($p->status) }}</span></td>
                        <td class="text-end fw-bold">Rp {{ number_format($p->detail->sum('subtotal'),0,',','.') }}</td>
                        <td class="text-end pe-4"><a href="{{ route('pengadaan.pdf',$p->id) }}" class="btn btn-sm btn-outline-danger" target="_blank"><i class="bi bi-file-earmark-pdf me-1"></i>PDF</a></td>
                    </tr>
                    @empty
                    <tr><td colspan="6" class="text-center text-muted py-4">Tidak ada data.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div></div>
    </div>
</x-app-layout>
