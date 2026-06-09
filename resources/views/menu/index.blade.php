<x-app-layout>
    <x-slot name="header">Menu</x-slot>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Daftar Menu</h4>
            <small class="text-muted">Kelola semua item menu</small>
        </div>
        <a href="{{ route('menu.create') }}" class="btn btn-primary"><i class="bi bi-plus me-1"></i>Tambah Menu</a>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">Menu</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($menus as $item)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/'.$item->gambar) }}" class="rounded-2" style="width:40px;height:40px;object-fit:cover;">
                                    @else
                                        <div class="rounded-2 bg-light d-flex align-items-center justify-content-center" style="width:40px;height:40px;"><i class="bi bi-image text-muted"></i></div>
                                    @endif
                                    <span class="fw-semibold">{{ $item->nama }}</span>
                                </div>
                            </td>
                            <td><span class="badge bg-light text-secondary text-capitalize">{{ $item->kategori }}</span></td>
                            <td class="fw-semibold">Rp {{ number_format($item->harga,0,',','.') }}</td>
                            <td>
                                <span class="badge {{ $item->status==='aktif'?'bg-success':'bg-danger' }}">{{ ucfirst($item->status) }}</span>
                            </td>
                            <td class="text-end pe-4">
                                <a href="{{ route('menu.edit',$item->id) }}" class="btn btn-sm btn-outline-primary me-1">Edit</a>
                                <form action="{{ route('menu.destroy',$item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus menu ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="5" class="text-center text-muted py-5">Belum ada data menu.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if(method_exists($menus,'hasPages') && $menus->hasPages())
        <div class="card-footer bg-white">{{ $menus->links() }}</div>
        @endif
    </div>
</x-app-layout>
