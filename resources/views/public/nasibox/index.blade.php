<x-public-layout>
    <x-slot name="title">Paket Nasi Box</x-slot>
    <section class="py-5 mt-2">
        <div class="container py-3">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Nasi Box</span>
                <h1 class="section-title">Paket Nasi Box</h1>
                <p class="section-sub">Praktis dan lezat untuk semua kebutuhan</p>
            </div>
            <div class="row g-4">
                @forelse($pakets as $p)
                <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index*80 }}">
                    <div class="card border-0 shadow-sm card-hover h-100">
                        <div class="card-body p-4">
                            <span class="badge-kategori mb-3 d-inline-block">Nasi Box</span>
                            <h5 class="fw-bold mb-2">{{ $p->nama }}</h5>
                            <p class="text-muted small mb-3" style="line-height:1.7;">{{ Str::limit($p->deskripsi ?? 'Nasi box praktis dengan menu pilihan.', 100) }}</p>
                            <div class="mb-4">
                                <span class="text-muted small d-block mb-1">Harga per box</span>
                                <span class="fw-black" style="font-size:22px;color:var(--bbc-primary);">Rp {{ number_format($p->harga,0,',','.') }}</span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4 d-flex gap-2">
                            <a href="{{ route('public.nasibox.show',$p->id) }}" class="btn btn-bbc-outline rounded-pill flex-fill">Detail</a>
                            <a href="{{ route('public.order.nasibox',['paket_id'=>$p->id]) }}" class="btn btn-bbc rounded-pill flex-fill">Pesan</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center text-muted py-5">Belum ada paket nasi box.</div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
