<x-app-layout>
    <x-slot name="header">Dashboard</x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <small class="text-muted">{{ now()->translatedFormat('l, d F Y') }}</small>
        </div>
    </div>

    {{-- 6 Widget Sesuai Blueprint --}}
    <div class="row g-3 mb-4">
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing:.06em;font-size:11px;">Pemasukan Hari Ini</p>
                    <h4 class="fw-bold mb-0">Rp {{ number_format($totalPemasukan,0,',','.') }}</h4>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing:.06em;font-size:11px;">Total Transaksi</p>
                    <h4 class="fw-bold mb-0">{{ $totalTransaksi }}</h4>
                    <small class="text-muted">Dine-in hari ini</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing:.06em;font-size:11px;">Catering Aktif</p>
                    <h4 class="fw-bold mb-0">{{ $cateringAktif }}</h4>
                    <small class="text-muted">Menunggu → Diproduksi</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing:.06em;font-size:11px;">Nasi Box Aktif</p>
                    <h4 class="fw-bold mb-0">{{ $nasiboxAktif }}</h4>
                    <small class="text-muted">Sedang diproses</small>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-4">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <p class="text-muted small text-uppercase fw-semibold mb-1" style="letter-spacing:.06em;font-size:11px;">Stok Menipis</p>
                    <h4 class="fw-bold mb-0 {{ $stokMenipis->count() > 0 ? 'text-danger' : '' }}">{{ $stokMenipis->count() }}</h4>
                    <small class="text-muted">Di bawah minimum</small>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-4">
        {{-- Grafik 7 Hari --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-semibold mb-0">Penjualan 7 Hari Terakhir</h6>
                </div>
                <div class="card-body">
                    <canvas id="grafikPenjualan" height="180"></canvas>
                </div>
            </div>
        </div>

        {{-- Produk Terlaris --}}
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-header bg-white border-bottom py-3">
                    <h6 class="fw-semibold mb-0">Produk Terlaris (30 Hari)</h6>
                </div>
                <div class="card-body p-0">
                    <ul class="list-group list-group-flush">
                        @forelse($produkTerlaris as $i => $p)
                        <li class="list-group-item d-flex justify-content-between align-items-center px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <span class="badge bg-light text-secondary fw-bold">{{ $i+1 }}</span>
                                <span style="font-size:13px;font-weight:500;">{{ $p->nama }}</span>
                            </div>
                            <span class="badge bg-primary rounded-pill">{{ $p->total_terjual }}x</span>
                        </li>
                        @empty
                        <li class="list-group-item text-center text-muted py-4" style="font-size:13px;">Belum ada data penjualan</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

    {{-- Stok Menipis --}}
    <div class="card border-0 shadow-sm">
        <div class="card-header bg-white border-bottom py-3 d-flex justify-content-between align-items-center">
            <h6 class="fw-semibold mb-0">Peringatan Stok Bahan Baku</h6>
            @if(in_array(auth()->user()->role, ['pemilik']))
            <a href="{{ route('pengadaan.create') }}" class="btn btn-sm btn-primary">
                <i class="bi bi-plus me-1"></i>Pengadaan
            </a>
            @endif
        </div>
        <div class="card-body p-0">
            @if($stokMenipis->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover mb-0 align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4" style="font-size:11px;">Bahan Baku</th>
                            <th style="font-size:11px;">Sisa Stok</th>
                            <th style="font-size:11px;">Minimum</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($stokMenipis as $item)
                        <tr>
                            <td class="ps-4 fw-semibold" style="font-size:13px;">{{ $item->nama }}</td>
                            <td class="text-danger fw-bold">{{ $item->stok }} {{ $item->satuan }}</td>
                            <td class="text-muted">{{ $item->batas_minimum }} {{ $item->satuan }}</td>
                            <td class="text-end pe-4">
                                @if($role === 'pemilik')
                                <a href="{{ route('pengadaan.create') }}" class="btn btn-sm btn-outline-primary">Restock</a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="text-center text-muted py-4">
                <i class="bi bi-check-circle text-success fs-4 d-block mb-1"></i>
                Semua stok bahan baku aman
            </div>
            @endif
        </div>
    </div>

    @push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script>
        const labels = {!! json_encode($grafikData->pluck('label')) !!};
        const values = {!! json_encode($grafikData->pluck('nilai')) !!};
        new Chart(document.getElementById('grafikPenjualan'), {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Penjualan (Rp)',
                    data: values,
                    backgroundColor: 'rgba(13,110,253,0.15)',
                    borderColor: '#0d6efd',
                    borderWidth: 2,
                    borderRadius: 5,
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: { color: '#F0F0F0' },
                        ticks: { callback: v => 'Rp ' + (v/1000).toLocaleString('id-ID') + 'k', font: { size: 10 } }
                    },
                    x: { grid: { display: false }, ticks: { font: { size: 11 } } }
                }
            }
        });
    </script>
    @endpush
</x-app-layout>
