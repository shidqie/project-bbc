<x-public-layout>
    <x-slot name="title">Kontak</x-slot>
    <section class="py-5 mt-2">
        <div class="container py-3">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Hubungi Kami</span>
                <h1 class="section-title">Kontak</h1>
                <p class="section-sub">Kami siap membantu Anda</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-5" data-aos="fade-right">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body p-4 p-md-5">
                            <h5 class="fw-bold mb-4">Informasi Kontak</h5>
                            @foreach([
                                ['bi-geo-alt-fill','Alamat','Jl. Contoh No. 1, RT 02/05,<br>Kecamatan X, Kota Y'],
                                ['bi-telephone-fill','Telepon / WhatsApp','+62 812-3456-7890'],
                                ['bi-envelope-fill','Email','info@warungbbc.com'],
                                ['bi-clock-fill','Jam Operasional','Senin – Sabtu: 07.00 – 21.00<br>Minggu: 08.00 – 18.00'],
                            ] as [$icon,$lab,$val])
                            <div class="d-flex gap-3 mb-4">
                                <div style="width:40px;height:40px;background:#ECFDF5;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                                    <i class="bi {{ $icon }} text-success"></i>
                                </div>
                                <div>
                                    <p class="text-muted small mb-1">{{ $lab }}</p>
                                    <p class="fw-semibold mb-0" style="font-size:14px;">{!! $val !!}</p>
                                </div>
                            </div>
                            @endforeach

                            <hr>
                            <p class="fw-semibold small mb-3">Media Sosial</p>
                            <div class="d-flex gap-3">
                                <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width:38px;height:38px;"><i class="bi bi-instagram"></i></a>
                                <a href="#" class="btn btn-outline-secondary rounded-circle d-flex align-items-center justify-content-center" style="width:38px;height:38px;"><i class="bi bi-facebook"></i></a>
                                <a href="https://wa.me/6281234567890" class="btn btn-success rounded-circle d-flex align-items-center justify-content-center text-white" style="width:38px;height:38px;"><i class="bi bi-whatsapp"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7" data-aos="fade-left">
                    {{-- Google Maps Embed Placeholder --}}
                    <div class="card border-0 shadow-sm overflow-hidden" style="height:100%;min-height:400px;">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15865.25!2d106.816666!3d-6.2!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMDAuMCJTIDEwNsKwNDknMDAuMCJF!5e0!3m2!1sid!2sid!4v1234567890"
                            width="100%" height="100%" style="border:0;min-height:400px;" allowfullscreen loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5" data-aos="fade-up">
                <h5 class="fw-bold mb-3">Siap Memesan?</h5>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('public.order.catering') }}" class="btn btn-bbc rounded-pill px-5">
                        <i class="bi bi-bag-plus me-2"></i>Pesan Catering
                    </a>
                    <a href="{{ route('public.order.nasibox') }}" class="btn btn-bbc-outline rounded-pill px-5">
                        <i class="bi bi-box-seam me-2"></i>Pesan Nasi Box
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-public-layout>
