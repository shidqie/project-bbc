<x-app-layout>
    <x-slot name="header">Laporan</x-slot>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="fw-bold mb-0">Laporan</h4>
    </div>

    @include('laporan.partials.tabs')

    {{-- Filter --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('laporan.penjualan') }}" class="row g-2 align-items-end">
                <div class="col-auto">
                    <label class="form-label small">Dari</label>
                    <input type="date" name="start_date" value="{{ $startDate }}" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <label class="form-label small">Sampai</label>
                    <input type="date" name="end_date" value="{{ $endDate }}" class="form-control form-control-sm">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                    <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary ms-1"><i class="bi bi-printer me-1"></i>Cetak</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Stats --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body py-3">
                    <p class="text-muted small mb-1">Grand Total</p>
                    <h5 class="fw-bold text-primary mb-0">Rp {{ number_format($grandTotal,0,',','.') }}</h5>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body py-3">
                    <p class="text-muted small mb-1">Dine-In</p>
                    <h6 class="fw-bold mb-0">Rp {{ number_format($totalDineIn,0,',','.') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body py-3">
                    <p class="text-muted small mb-1">Catering</p>
                    <h6 class="fw-bold mb-0">Rp {{ number_format($totalCatering,0,',','.') }}</h6>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card border-0 shadow-sm text-center">
                <div class="card-body py-3">
                    <p class="text-muted small mb-1">Nasi Box</p>
                    <h6 class="fw-bold mb-0">Rp {{ number_format($totalNasibox,0,',','.') }}</h6>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white py-3"><h6 class="fw-semibold mb-0">Rincian Transaksi</h6></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Tanggal</th>
                            <th>No. Ref</th>
                            <th>Jenis</th>
                            <th class="text-end pe-4">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transaksi as $t)
                        <tr>
                            <td class="ps-4 text-muted small">{{ \Carbon\Carbon::parse($t['tanggal'])->format('d M Y H:i') }}</td>
                            <td class="fw-semibold">{{ $t['ref'] }}</td>
                            <td><span class="badge bg-light text-secondary">{{ $t['jenis'] }}</span></td>
                            <td class="text-end pe-4 fw-bold">Rp {{ number_format($t['total'],0,',','.') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center text-muted py-5">Tidak ada transaksi pada periode ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
