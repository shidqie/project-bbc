<x-public-layout>
    <x-slot name="title">Tentang Kami</x-slot>

    <section class="py-5 mt-2">
        <div class="container py-3">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Profil Usaha</span>
                <h1 class="section-title">Tentang Warung BBC</h1>
                <p class="section-sub">Mengenal lebih dekat dapur kami</p>
            </div>
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6" data-aos="fade-right">
                    <div style="background:#F3F4F6;border-radius:20px;height:380px;display:flex;align-items:center;justify-content:center;">
                        <i class="bi bi-shop" style="font-size:100px;color:#D1D5DB;"></i>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <span class="badge-kategori mb-3 d-inline-block">Sejarah Kami</span>
                    <h2 class="fw-bold mb-4" style="font-size:1.8rem;">Berawal dari Dapur Kecil</h2>
                    <p class="text-muted mb-3" style="line-height:1.8;">
                        Warung BBC didirikan pada tahun 2018 dengan visi sederhana: menyajikan makanan bergizi dan lezat yang dapat dinikmati oleh semua kalangan. Bermula dari pesanan keluarga dan tetangga, kini kami telah melayani ratusan acara setiap tahunnya.
                    </p>
                    <p class="text-muted" style="line-height:1.8;">
                        Dengan tim yang berpengalaman dan bahan baku pilihan, kami terus berinovasi untuk menghadirkan pengalaman kuliner terbaik.
                    </p>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6" data-aos="fade-up">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="mb-3" style="width:44px;height:44px;background:#ECFDF5;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-eye text-success fs-5"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Visi</h5>
                        <p class="text-muted mb-0" style="line-height:1.75;">Menjadi pilihan utama layanan catering dan nasi box yang dikenal dengan kualitas, kebersihan, dan kepuasan pelanggan di seluruh wilayah.</p>
                    </div>
                </div>
                <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="card border-0 shadow-sm p-4 h-100">
                        <div class="mb-3" style="width:44px;height:44px;background:#EFF6FF;border-radius:12px;display:flex;align-items:center;justify-content:center;">
                            <i class="bi bi-flag text-primary fs-5"></i>
                        </div>
                        <h5 class="fw-bold mb-2">Misi</h5>
                        <ul class="text-muted mb-0 ps-3" style="line-height:2;">
                            <li>Menyajikan makanan berkualitas dengan harga terjangkau</li>
                            <li>Menjaga standar kebersihan dan kehalalan</li>
                            <li>Memberikan pelayanan yang ramah dan profesional</li>
                            <li>Berinovasi dalam menu sesuai tren kuliner</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row g-4">
                @foreach([['500+','Acara Dilayani'],['50+','Varian Menu'],['5+','Tahun Pengalaman'],['⭐ 4.9','Rating Pelanggan']] as [$val,$lab])
                <div class="col-6 col-md-3" data-aos="fade-up">
                    <div class="card border-0 shadow-sm text-center p-4">
                        <h3 class="fw-black mb-1" style="color:var(--bbc-primary);">{{ $val }}</h3>
                        <p class="text-muted small mb-0">{{ $lab }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</x-public-layout>
