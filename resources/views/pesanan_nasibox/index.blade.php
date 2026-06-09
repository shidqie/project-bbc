<x-app-layout>
    <x-slot name="header">Pesanan Nasi Box</x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Pesanan Nasi Box</h4>
            <small class="text-muted">Kelola semua pesanan nasi box</small>
        </div>
        @if(in_array(auth()->user()->role, ['pemilik','manager']))
        <a href="{{ route('pesanan-nasibox.create') }}" class="btn btn-primary"><i class="bi bi-plus me-1"></i>Tambah Pesanan</a>
        @endif
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Pelanggan</th>
                            <th>Paket</th>
                            <th>Qty</th>
                            <th>Kirim</th>
                            <th>Status</th>
                            <th class="text-end">Total</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pesanans as $p)
                        @php
                        $statusColors = ['diproses'=>'warning text-dark','dikirim'=>'info text-dark','selesai'=>'success','dibatalkan'=>'danger'];
                        $color = $statusColors[$p->status] ?? 'secondary';
                        @endphp
                        <tr>
                            <td class="ps-4 text-muted small">NB-{{ str_pad($p->id,4,'0',STR_PAD_LEFT) }}</td>
                            <td class="fw-semibold">{{ $p->pelanggan->nama ?? '-' }}</td>
                            <td>{{ $p->paketNasibox->nama ?? '-' }}</td>
                            <td>{{ $p->qty }} box</td>
                            <td class="small">{{ \Carbon\Carbon::parse($p->tanggal_kirim)->format('d M Y') }}</td>
                            <td><span class="badge bg-{{ $color }}" style="font-size:11px;">{{ ucfirst($p->status) }}</span></td>
                            <td class="text-end fw-bold">Rp {{ number_format($p->total_harga,0,',','.') }}</td>
                            <td class="text-end pe-4">
                                <a href="{{ route('pesanan-nasibox.show',$p->id) }}" class="btn btn-sm btn-outline-primary">Detail</a>
                                @if(in_array(auth()->user()->role, ['pemilik','manager']) && !in_array($p->status, ['selesai','dibatalkan']))
                                <button type="button" class="btn btn-sm btn-outline-secondary"
                                    data-bs-toggle="modal" data-bs-target="#statusModal"
                                    data-id="{{ $p->id }}" data-status="{{ $p->status }}"
                                    onclick="prepModal(this)">Update</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="8" class="text-center text-muted py-5">Belum ada pesanan nasi box.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($pesanans->hasPages())
        <div class="card-footer bg-white">{{ $pesanans->links() }}</div>
        @endif
    </div>

    @if(in_array(auth()->user()->role, ['pemilik','manager']))
    <div class="modal fade" id="statusModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header"><h6 class="modal-title fw-bold">Update Status</h6><button class="btn-close" data-bs-dismiss="modal"></button></div>
                <form id="statusForm" method="POST">
                    @csrf @method('PATCH')
                    <div class="modal-body">
                        <select name="status" class="form-select form-select-sm">
                            <option value="diproses">Diproses</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="selesai">Selesai</option>
                            <option value="dibatalkan">Dibatalkan</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary btn-sm w-100">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    function prepModal(btn){
        document.getElementById('statusForm').action='/pesanan-nasibox/'+btn.dataset.id+'/status';
        document.querySelector('#statusModal select').value=btn.dataset.status;
    }
    </script>
    @endif
</x-app-layout>
