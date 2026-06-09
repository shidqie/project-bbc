<x-app-layout>
    <x-slot name="header">Laporan Persediaan</x-slot>
    <h4 class="fw-bold mb-3">Laporan</h4>
    @include('laporan.partials.tabs')
    <div class="d-flex justify-content-end mb-3">
        <button onclick="window.print()" class="btn btn-sm btn-outline-secondary"><i class="bi bi-printer me-1"></i>Cetak</button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Total Item</p><h5 class="fw-bold mb-0">{{ $totalItem }}</h5></div></div></div>
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Stok Aman</p><h5 class="fw-bold text-success mb-0">{{ $stokNormal }}</h5></div></div></div>
        <div class="col-4"><div class="card border-0 shadow-sm text-center"><div class="card-body py-3"><p class="text-muted small mb-1">Stok Menipis</p><h5 class="fw-bold {{ $stokMenipis>0?'text-danger':'' }} mb-0">{{ $stokMenipis }}</h5></div></div></div>
    </div>
    <div class="card border-0 shadow-sm"><div class="card-header bg-white py-3"><h6 class="fw-semibold mb-0">Data Stok Bahan Baku</h6></div>
        <div class="card-body p-0"><div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light"><tr>
                    <th class="ps-4">Bahan Baku</th><th>Satuan</th><th>Stok</th><th>Minimum</th><th>Status</th>
                </tr></thead>
                <tbody>
                    @foreach($bahanBakus as $b)
                    @php $menipis = $b->stok <= $b->batas_minimum; @endphp
                    <tr>
                        <td class="ps-4 fw-semibold">{{ $b->nama }}</td>
                        <td>{{ $b->satuan }}</td>
                        <td class="{{ $menipis?'text-danger fw-bold':'' }}">{{ $b->stok }}</td>
                        <td class="text-muted">{{ $b->batas_minimum }}</td>
                        <td><span class="badge {{ $menipis?'bg-danger':'bg-success' }}">{{ $menipis?'Menipis':'Aman' }}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div></div>
    </div>
</x-app-layout>
