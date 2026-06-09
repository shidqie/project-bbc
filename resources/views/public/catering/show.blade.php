<x-public-layout>
    <x-slot name="title">{{ $paket->nama }}</x-slot>
    <section class="py-5 mt-2">
        <div class="container py-3" style="max-width:820px;">
            <a href="{{ route('public.catering') }}" class="btn btn-outline-secondary btn-sm rounded-pill mb-4">
                <i class="bi bi-arrow-left me-1"></i>Kembali
            </a>
            <div class="card border-0 shadow-sm overflow-hidden mb-4" data-aos="fade-up">
                <div class="card-body p-4 p-md-5">
                    <span class="badge-kategori mb-3 d-inline-block">Paket Catering</span>
                    <h1 class="fw-black mb-2" style="font-size:2rem;">{{ $paket->nama }}</h1>
                    <p class="text-muted mb-4" style="line-height:1.8;">{{ $paket->deskripsi ?? 'Paket catering spesial dengan menu lengkap dan bergizi.' }}</p>

                    <div class="row g-3 mb-4">
                        <div class="col-sm-4">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <div class="fw-black" style="font-size:1.5rem;color:var(--bbc-primary);">Rp {{ number_format($paket->harga,0,',','.') }}</div>
                                <div class="text-muted small">per porsi</div>
                            </div>
                        </div>
                        @if($paket->minimum_order)
                        <div class="col-sm-4">
                            <div class="bg-light rounded-3 p-3 text-center">
                                <div class="fw-black fs-4">{{ $paket->minimum_order }}</div>
                                <div class="text-muted small">Minimum porsi</div>
                            </div>
                        </div>
                        @endif
                    </div>

                    @if($paket->detail && $paket->detail->count())
                    <h5 class="fw-bold mb-3">Menu dalam Paket</h5>
                    <div class="row g-2 mb-4">
                        @foreach($paket->detail as $d)
                        <div class="col-sm-6">
                            <div class="d-flex align-items-center gap-2 p-2 rounded-2 bg-light">
                                <i class="bi bi-check-circle-fill text-success"></i>
                                <span style="font-size:14px;">{{ $d->menu->nama ?? '-' }}</span>
                                @if(isset($d->qty))<span class="text-muted small ms-auto">{{ $d->qty }}x</span>@endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endif

                    <a href="{{ route('public.order.catering',['paket_id'=>$paket->id]) }}"
                       class="btn btn-bbc btn-lg rounded-pill px-5 fw-bold">
                        <i class="bi bi-bag-plus me-2"></i>Pesan Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
