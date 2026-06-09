<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $metaDesc ?? 'Warung BBC — Catering & Nasi Box terpercaya. Pesan sekarang!' }}">
    <title>@isset($title){{ $title }} — @endisset Warung BBC</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --bbc-primary: #16A34A;
            --bbc-dark:    #111827;
            --bbc-light:   #F9FAFB;
        }
        body { font-family:'Inter',sans-serif; color:#374151; }
        /* Navbar */
        .navbar-bbc { background:#fff; box-shadow:0 1px 0 #E5E7EB; }
        .navbar-brand-text { font-weight:800; font-size:20px; color:var(--bbc-dark)!important; }
        .navbar-brand-dot  { color:var(--bbc-primary); }
        .nav-link { font-size:14px; font-weight:500; color:#374151!important; }
        .nav-link:hover, .nav-link.active { color:var(--bbc-primary)!important; }
        /* Buttons */
        .btn-bbc   { background:var(--bbc-primary); color:#fff; border:none; font-weight:600; }
        .btn-bbc:hover { background:#15803D; color:#fff; }
        .btn-bbc-outline { border:2px solid var(--bbc-primary); color:var(--bbc-primary); font-weight:600; background:transparent; }
        .btn-bbc-outline:hover { background:var(--bbc-primary); color:#fff; }
        /* Hero */
        .hero { background:linear-gradient(135deg,#111827 60%,#1F2937 100%); min-height:88vh; display:flex; align-items:center; }
        /* Cards */
        .card-hover { transition:all .2s; }
        .card-hover:hover { transform:translateY(-6px); box-shadow:0 16px 40px rgba(0,0,0,.12)!important; }
        /* Badge kategori */
        .badge-kategori { background:#ECFDF5; color:var(--bbc-primary); font-size:11px; font-weight:600; border-radius:99px; padding:3px 10px; }
        /* Section */
        .section-title { font-size:32px; font-weight:800; color:var(--bbc-dark); }
        .section-sub   { font-size:16px; color:#6B7280; }
        /* Footer */
        footer { background:#111827; color:#D1D5DB; }
        footer a { color:#9CA3AF; text-decoration:none; }
        footer a:hover { color:#fff; }
        /* Tracking stepper */
        .step { display:flex; align-items:flex-start; gap:16px; }
        .step-icon { width:36px; height:36px; border-radius:50%; display:flex; align-items:center; justify-content:center; flex-shrink:0; font-size:14px; font-weight:700; }
        .step-done { background:#DCFCE7; color:#16A34A; }
        .step-active { background:#16A34A; color:#fff; }
        .step-pending { background:#F3F4F6; color:#9CA3AF; }
    </style>
</head>
<body>

{{-- Navbar --}}
<nav class="navbar navbar-expand-lg navbar-bbc sticky-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="{{ route('public.home') }}">
            <div class="rounded-2 d-flex align-items-center justify-content-center"
                 style="width:32px;height:32px;background:var(--bbc-primary);">
                <i class="bi bi-shop text-white" style="font-size:16px;"></i>
            </div>
            <span class="navbar-brand-text">Warung<span class="navbar-brand-dot"> BBC</span></span>
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav mx-auto gap-1">
                @foreach([
                    'public.home'    => 'Home',
                    'public.about'   => 'Tentang Kami',
                    'public.menus'   => 'Menu',
                    'public.catering'=> 'Catering',
                    'public.nasibox' => 'Nasi Box',
                    'public.tracking'=> 'Tracking',
                    'public.contact' => 'Kontak',
                ] as $route => $label)
                <li class="nav-item">
                    <a class="nav-link px-3 rounded-2 {{ request()->routeIs($route) ? 'active fw-semibold' : '' }}"
                       href="{{ route($route) }}">{{ $label }}</a>
                </li>
                @endforeach
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('public.order.catering') }}" class="btn btn-bbc btn-sm rounded-pill px-4">
                    <i class="bi bi-bag-plus me-1"></i>Pesan Catering
                </a>
            </div>
        </div>
    </div>
</nav>

{{-- Flash Messages --}}
@if(session('success'))
<div class="container mt-3">
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2">
        <i class="bi bi-check-circle-fill text-success"></i>
        {{ session('success') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif
@if(session('error'))
<div class="container mt-3">
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center gap-2">
        <i class="bi bi-exclamation-triangle-fill"></i>
        {{ session('error') }}
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

{{-- Content --}}
{{ $slot }}

{{-- Footer --}}
<footer class="py-5 mt-5">
    <div class="container">
        <div class="row g-4">
            <div class="col-lg-4">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="rounded-2 d-flex align-items-center justify-content-center"
                         style="width:28px;height:28px;background:var(--bbc-primary);">
                        <i class="bi bi-shop text-white" style="font-size:13px;"></i>
                    </div>
                    <span style="font-weight:800;font-size:16px;color:#fff;">Warung BBC</span>
                </div>
                <p style="font-size:13px;color:#9CA3AF;line-height:1.7;">
                    Catering dan Nasi Box terpercaya. Melayani berbagai kebutuhan acara dengan cita rasa terbaik.
                </p>
                <div class="d-flex gap-3 mt-3">
                    <a href="#" class="text-muted fs-5"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-muted fs-5"><i class="bi bi-facebook"></i></a>
                    <a href="https://wa.me/6281234567890" class="text-muted fs-5"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-3" style="font-size:13px;">Layanan</h6>
                <ul class="list-unstyled" style="font-size:13px;">
                    <li class="mb-2"><a href="{{ route('public.catering') }}">Catering</a></li>
                    <li class="mb-2"><a href="{{ route('public.nasibox') }}">Nasi Box</a></li>
                    <li class="mb-2"><a href="{{ route('public.menus') }}">Menu</a></li>
                    <li class="mb-2"><a href="{{ route('public.tracking') }}">Tracking</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-6">
                <h6 class="text-white fw-bold mb-3" style="font-size:13px;">Perusahaan</h6>
                <ul class="list-unstyled" style="font-size:13px;">
                    <li class="mb-2"><a href="{{ route('public.about') }}">Tentang Kami</a></li>
                    <li class="mb-2"><a href="{{ route('public.contact') }}">Kontak</a></li>
                </ul>
            </div>
            <div class="col-lg-4">
                <h6 class="text-white fw-bold mb-3" style="font-size:13px;">Kontak</h6>
                <ul class="list-unstyled" style="font-size:13px;color:#9CA3AF;">
                    <li class="mb-2"><i class="bi bi-geo-alt me-2 text-green-400"></i>Jl. Contoh No. 1, Kota</li>
                    <li class="mb-2"><i class="bi bi-telephone me-2"></i>+62 812-3456-7890</li>
                    <li class="mb-2"><i class="bi bi-envelope me-2"></i>info@warungbbc.com</li>
                    <li class="mb-2"><i class="bi bi-clock me-2"></i>Senin–Sabtu, 07.00–21.00</li>
                </ul>
            </div>
        </div>
        <hr style="border-color:#374151;margin-top:32px;">
        <div class="d-flex justify-content-between align-items-center" style="font-size:12px;color:#6B7280;">
            <span>© {{ date('Y') }} Warung BBC. All rights reserved.</span>
            <a href="{{ route('login') }}" class="text-muted">Admin Login</a>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>AOS.init({ duration: 700, once: true });</script>
@stack('scripts')
</body>
</html>
