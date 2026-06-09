<x-public-layout>

{{-- ═══ HERO ═══════════════════════════════════════════════════════════════ --}}
<section class="hero position-relative overflow-hidden">
    <div class="container py-5">
        <div class="row align-items-center min-vh-75 py-5">
            <div class="col-lg-6" data-aos="fade-right">
                <span class="badge rounded-pill px-3 py-2 mb-4" style="background:rgba(22,163,74,.15);color:#4ADE80;font-size:12px;font-weight:600;">
                    <i class="bi bi-star-fill me-1"></i> Catering & Nasi Box Terpercaya
                </span>
                <h1 class="text-white fw-black mb-4" style="font-size:clamp(2.2rem,5vw,3.5rem);line-height:1.1;">
                    Cita Rasa Terbaik<br>
                    <span style="color:#4ADE80;">Untuk Setiap Momen</span>
                </h1>
                <p class="mb-5" style="font-size:17px;color:#9CA3AF;line-height:1.75;max-width:480px;">
                    Warung BBC hadir dengan paket catering dan nasi box berkualitas untuk acara Anda. Pesan sekarang, nikmati kemudahan!
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('public.order.catering') }}"
                       class="btn btn-bbc btn-lg rounded-pill px-5 fw-bold">
                        <i class="bi bi-bag-plus me-2"></i>Pesan Catering
                    </a>
                    <a href="{{ route('public.order.nasibox') }}"
                       class="btn btn-bbc-outline btn-lg rounded-pill px-5 fw-bold text-white border-white">
                        <i class="bi bi-box-seam me-2"></i>Pesan Nasi Box
                    </a>
                </div>
                <div class="d-flex gap-4 mt-5">
                    <div>
                        <div class="text-white fw-black fs-4">500+</div>
                        <div style="font-size:13px;color:#6B7280;">Acara Dilayani</div>
                    </div>
                    <div class="border-start border-secondary ps-4">
                        <div class="text-white fw-black fs-4">50+</div>
                        <div style="font-size:13px;color:#6B7280;">Paket Menu</div>
                    </div>
                    <div class="border-start border-secondary ps-4">
                        <div class="text-white fw-black fs-4">⭐ 4.9</div>
                        <div style="font-size:13px;color:#6B7280;">Rating Pelanggan</div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-flex justify-content-center" data-aos="fade-left" data-aos-delay="200">
                <div style="width:420px;height:420px;border-radius:30px;background:rgba(255,255,255,.05);display:flex;align-items:center;justify-content:center;border:1px solid rgba(255,255,255,.1);">
                    <i class="bi bi-shop" style="font-size:120px;color:rgba(74,222,128,.3);"></i>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ TENTANG SINGKAT ════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:#F9FAFB;">
    <div class="container py-3">
        <div class="row g-4 align-items-center">
            <div class="col-lg-5" data-aos="fade-right">
                <span class="badge-kategori mb-3 d-inline-block">Tentang Kami</span>
                <h2 class="section-title mb-3">Warung BBC —<br>Lebih dari Sekadar Makanan</h2>
                <p class="text-muted" style="line-height:1.8;">
                    Berdiri sejak 2018, Warung BBC telah melayani ratusan acara dari skala kecil hingga besar. Kami berkomitmen menghadirkan masakan bergizi, higienis, dan lezat untuk setiap momen berharga Anda.
                </p>
                <a href="{{ route('public.about') }}" class="btn btn-bbc rounded-pill px-4 mt-3">
                    Selengkapnya <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
            <div class="col-lg-7">
                <div class="row g-3">
                    @foreach([
                        ['bi-award','Berpengalaman','Lebih dari 5 tahun melayani pelanggan setia.'],
                        ['bi-shield-check','Higienis & Halal','Semua bahan baku dipilih ketat dan terjamin halal.'],
                        ['bi-truck','Pengiriman Tepat','Kami pastikan pesanan tiba tepat waktu di lokasi Anda.'],
                        ['bi-headset','Support 24/7','Tim kami siap membantu konsultasi kebutuhan acara Anda.'],
                    ] as [$icon,$title,$desc])
                    <div class="col-6" data-aos="fade-up">
                        <div class="card border-0 shadow-sm p-4 card-hover h-100">
                            <div class="mb-3" style="width:42px;height:42px;background:#ECFDF5;border-radius:10px;display:flex;align-items:center;justify-content:center;">
                                <i class="bi {{ $icon }} text-success fs-5"></i>
                            </div>
                            <h6 class="fw-bold mb-1">{{ $title }}</h6>
                            <p class="text-muted small mb-0">{{ $desc }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══ PAKET CATERING ═════════════════════════════════════════════════════ --}}
<section class="py-5">
    <div class="container py-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-kategori mb-3 d-inline-block">Catering</span>
            <h2 class="section-title">Paket Catering Unggulan</h2>
            <p class="section-sub">Cocok untuk arisan, rapat, hingga resepsi pernikahan</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($paketCaterings as $paket)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm card-hover h-100 overflow-hidden">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge-kategori">Catering</span>
                            @if($paket->minimum_order)
                            <span class="text-muted small">Min. {{ $paket->minimum_order }} porsi</span>
                            @endif
                        </div>
                        <h5 class="fw-bold mb-1">{{ $paket->nama }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($paket->deskripsi ?? '', 80) }}</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <span class="text-muted small d-block">Mulai dari</span>
                                <span class="fw-black" style="font-size:20px;color:var(--bbc-primary);">Rp {{ number_format($paket->harga,0,',','.') }}</span>
                                <span class="text-muted small">/porsi</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                        <a href="{{ route('public.catering.show',$paket->id) }}" class="btn btn-bbc-outline rounded-pill w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-4">Belum ada paket catering.</div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.catering') }}" class="btn btn-bbc rounded-pill px-5">Lihat Semua Paket <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

{{-- ═══ PAKET NASI BOX ═════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:#F9FAFB;">
    <div class="container py-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-kategori mb-3 d-inline-block">Nasi Box</span>
            <h2 class="section-title">Paket Nasi Box Populer</h2>
            <p class="section-sub">Praktis untuk rapat, seminar, dan berbagai acara</p>
        </div>
        <div class="row g-4 justify-content-center">
            @forelse($paketNasiboxes as $paket)
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm card-hover h-100">
                    <div class="card-body p-4">
                        <span class="badge-kategori mb-3 d-inline-block">Nasi Box</span>
                        <h5 class="fw-bold mb-1">{{ $paket->nama }}</h5>
                        <p class="text-muted small mb-3">{{ Str::limit($paket->deskripsi ?? '', 80) }}</p>
                        <div>
                            <span class="text-muted small d-block">Harga</span>
                            <span class="fw-black" style="font-size:20px;color:var(--bbc-primary);">Rp {{ number_format($paket->harga,0,',','.') }}</span>
                            <span class="text-muted small">/box</span>
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0 pt-0 pb-4 px-4">
                        <a href="{{ route('public.nasibox.show',$paket->id) }}" class="btn btn-bbc-outline rounded-pill w-100">Lihat Detail</a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center text-muted py-4">Belum ada paket nasi box.</div>
            @endforelse
        </div>
        <div class="text-center mt-4">
            <a href="{{ route('public.nasibox') }}" class="btn btn-bbc rounded-pill px-5">Lihat Semua <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</section>

{{-- ═══ TESTIMONI ════════════════════════════════════════════════════════════ --}}
<section class="py-5">
    <div class="container py-3">
        <div class="text-center mb-5" data-aos="fade-up">
            <span class="badge-kategori mb-3 d-inline-block">Testimoni</span>
            <h2 class="section-title">Kata Pelanggan Kami</h2>
        </div>
        <div class="row g-4">
            @foreach([
                ['Siti Rahma','Ibu Rumah Tangga','Catering untuk arisan saya sangat memuaskan! Makanannya enak dan pengirimannya tepat waktu.'],
                ['Budi Santoso','Manager Perusahaan','Nasi box untuk rapat kantor kami selalu fresh dan lezat. Sangat direkomendasikan!'],
                ['Dewi Lestari','Panitia Pernikahan','Terima kasih Warung BBC sudah bantu sukseskan resepsi kami. Tamunya puas semua!'],
            ] as [$nama,$profesi,$teks])
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card border-0 shadow-sm p-4 card-hover h-100">
                    <div class="d-flex gap-1 mb-3">
                        @for($s=0;$s<5;$s++)<i class="bi bi-star-fill text-warning" style="font-size:13px;"></i>@endfor
                    </div>
                    <p class="text-muted mb-4" style="font-size:14px;line-height:1.75;">"{{ $teks }}"</p>
                    <div class="d-flex align-items-center gap-3 mt-auto">
                        <div class="rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                             style="width:40px;height:40px;background:var(--bbc-primary);font-size:14px;flex-shrink:0;">
                            {{ strtoupper(substr($nama,0,1)) }}
                        </div>
                        <div>
                            <div class="fw-semibold" style="font-size:14px;">{{ $nama }}</div>
                            <div class="text-muted" style="font-size:12px;">{{ $profesi }}</div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══ CTA BANNER ══════════════════════════════════════════════════════════ --}}
<section class="py-5" style="background:var(--bbc-primary);">
    <div class="container text-center py-3" data-aos="fade-up">
        <h2 class="text-white fw-black mb-3" style="font-size:2rem;">Siap Memesan?</h2>
        <p class="text-white mb-4" style="opacity:.85;">Hubungi kami sekarang atau langsung isi form pemesanan.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('public.order.catering') }}" class="btn bg-white text-success fw-bold rounded-pill px-5">
                <i class="bi bi-bag-plus me-2"></i>Pesan Catering
            </a>
            <a href="{{ route('public.order.nasibox') }}" class="btn btn-outline-light fw-bold rounded-pill px-5">
                <i class="bi bi-box-seam me-2"></i>Pesan Nasi Box
            </a>
        </div>
    </div>
</section>

</x-public-layout>
