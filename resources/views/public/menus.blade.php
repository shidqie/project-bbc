<x-public-layout>
    <x-slot name="title">Menu</x-slot>

    <section class="py-5 mt-2">
        <div class="container py-3">
            <div class="text-center mb-4" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Katalog</span>
                <h1 class="section-title">Menu Kami</h1>
                <p class="section-sub">Tersedia berbagai pilihan makanan & minuman</p>
            </div>

            {{-- Filter --}}
            <div class="d-flex justify-content-center gap-2 mb-5 flex-wrap" data-aos="fade-up">
                @foreach(['semua'=>'Semua','makanan'=>'Makanan','minuman'=>'Minuman','cemilan'=>'Cemilan','paket'=>'Paket'] as $val=>$lab)
                <a href="{{ route('public.menus',['kategori'=>$val]) }}"
                   class="btn rounded-pill px-4 {{ $kategori===$val ? 'btn-bbc' : 'btn-outline-secondary' }}"
                   style="font-size:13px;">{{ $lab }}</a>
                @endforeach
            </div>

            {{-- Grid --}}
            <div class="row g-4">
                @forelse($menus as $menu)
                <div class="col-sm-6 col-md-4 col-lg-3" data-aos="fade-up">
                    <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                        @if($menu->gambar)
                            <img src="{{ asset('storage/'.$menu->gambar) }}" class="card-img-top" style="height:180px;object-fit:cover;">
                        @else
                            <div style="height:180px;background:#F3F4F6;display:flex;align-items:center;justify-content:center;">
                                <i class="bi bi-cup-hot" style="font-size:48px;color:#D1D5DB;"></i>
                            </div>
                        @endif
                        <div class="card-body p-3">
                            <span class="badge-kategori mb-2 d-inline-block text-capitalize">{{ $menu->kategori }}</span>
                            <h6 class="fw-bold mb-1">{{ $menu->nama }}</h6>
                            <p class="fw-black mb-0" style="color:var(--bbc-primary);font-size:16px;">Rp {{ number_format($menu->harga,0,',','.') }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-cup fs-1 d-block mb-2"></i>Belum ada menu tersedia.
                </div>
                @endforelse
            </div>
        </div>
    </section>
</x-public-layout>
