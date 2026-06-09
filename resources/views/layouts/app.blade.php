<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@isset($title){{ $title }} — @endisset{{ config('app.name', 'Warung BBC') }}</title>

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    {{-- Google Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --sidebar-width: 230px;
            --topbar-height: 52px;
        }
        body { font-family: 'Inter', sans-serif; background-color: #F8F9FA; color: #212529; }

        /* Sidebar */
        #sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: #fff;
            border-right: 1px solid #DEE2E6;
            position: fixed;
            top: 0; left: 0;
            z-index: 1030;
            display: flex;
            flex-direction: column;
            transition: transform .25s ease;
        }
        .sidebar-brand {
            height: var(--topbar-height);
            border-bottom: 1px solid #DEE2E6;
            padding: 0 16px;
            display: flex; align-items: center; gap: 10px;
            text-decoration: none;
        }
        .sidebar-brand-icon {
            width: 28px; height: 28px;
            background: #0d6efd; border-radius: 7px;
            display: flex; align-items: center; justify-content: center;
            color: #fff; font-size: 14px; flex-shrink: 0;
        }
        .sidebar-brand-text { font-size: 14px; font-weight: 700; color: #212529; }
        .sidebar-nav { padding: 12px 8px; flex: 1; overflow-y: auto; }
        .sidebar-section-label {
            font-size: 10px; font-weight: 700; text-transform: uppercase;
            letter-spacing: .07em; color: #ADB5BD;
            padding: 14px 10px 6px; display: block;
        }
        .sidebar-link {
            display: flex; align-items: center; gap: 9px;
            padding: 7px 10px; border-radius: 7px;
            font-size: 13px; font-weight: 500; color: #495057;
            text-decoration: none; transition: all .15s; margin-bottom: 2px;
        }
        .sidebar-link:hover { background: #F8F9FA; color: #212529; }
        .sidebar-link.active { background: #0d6efd; color: #fff; }
        .sidebar-link i { font-size: 15px; width: 18px; text-align: center; }

        /* Topbar */
        #topbar {
            position: fixed; top: 0;
            left: var(--sidebar-width); right: 0;
            height: var(--topbar-height);
            background: #fff; border-bottom: 1px solid #DEE2E6;
            display: flex; align-items: center; justify-content: space-between;
            padding: 0 20px; z-index: 1020;
        }
        /* Content */
        #content-wrapper {
            margin-left: var(--sidebar-width);
            padding-top: var(--topbar-height);
            min-height: 100vh;
        }
        #main-content { padding: 28px 24px; }

        /* Mobile */
        @media (max-width: 768px) {
            #sidebar { transform: translateX(-100%); }
            #sidebar.show { transform: translateX(0); }
            #topbar { left: 0; }
            #content-wrapper { margin-left: 0; }
        }
    </style>

    @stack('styles')
</head>
<body>

{{-- Sidebar --}}
<nav id="sidebar">
    <a href="{{ route('dashboard') }}" class="sidebar-brand">
        <div class="sidebar-brand-icon"><i class="bi bi-shop"></i></div>
        <span class="sidebar-brand-text">Warung BBC</span>
    </a>

    <div class="sidebar-nav">
        @php $role = auth()->user()->role; @endphp

        {{-- Dashboard --}}
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a>

        {{-- POS — Kasir & Pemilik --}}
        @if(in_array($role, ['kasir','pemilik']))
        <a href="{{ route('pos.index') }}" class="sidebar-link {{ request()->routeIs('pos.*') ? 'active' : '' }}">
            <i class="bi bi-upc-scan"></i> Kasir (POS)
        </a>
        @endif

        {{-- Operasional — semua kecuali hanya kasir (kasir tidak lihat pesanan) --}}
        @if(in_array($role, ['pemilik','manager','dapur','pelayan']))
        <span class="sidebar-section-label">Operasional</span>
        <a href="{{ route('pesanan-catering.index') }}" class="sidebar-link {{ request()->routeIs('pesanan-catering.*') ? 'active' : '' }}">
            <i class="bi bi-journal-text"></i> Catering
        </a>
        <a href="{{ route('pesanan-nasibox.index') }}" class="sidebar-link {{ request()->routeIs('pesanan-nasibox.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i> Nasi Box
        </a>
        @endif

        {{-- Pengadaan — Pemilik only --}}
        @if($role === 'pemilik')
        <a href="{{ route('pengadaan.index') }}" class="sidebar-link {{ request()->routeIs('pengadaan.*') ? 'active' : '' }}">
            <i class="bi bi-cart-plus"></i> Pengadaan
        </a>
        @endif

        {{-- Laporan — Manager & Pemilik --}}
        @if(in_array($role, ['pemilik','manager']))
        <span class="sidebar-section-label">Laporan</span>
        @foreach(['laporan.penjualan'=>'Penjualan','laporan.catering'=>'Catering','laporan.nasibox'=>'Nasi Box','laporan.persediaan'=>'Persediaan','laporan.pengadaan'=>'Pengadaan'] as $r=>$l)
        <a href="{{ route($r) }}" class="sidebar-link {{ request()->routeIs($r) ? 'active' : '' }}" style="padding-left:22px;">
            <i class="bi bi-dot" style="font-size:20px;margin-left:-4px;"></i> {{ $l }}
        </a>
        @endforeach
        @endif

        {{-- Master Data — Pemilik only --}}
        @if($role === 'pemilik')
        <span class="sidebar-section-label">Master Data</span>
        @foreach(['menu'=>['bi-cup-hot','Menu'],'bahan-baku'=>['bi-basket','Bahan Baku'],'paket-catering'=>['bi-clipboard2-check','Paket Catering'],'paket-nasibox'=>['bi-bag-check','Paket Nasi Box'],'pelanggan'=>['bi-people','Pelanggan'],'supplier'=>['bi-truck','Supplier'],'meja'=>['bi-table','Meja']] as $r=>$d)
        <a href="{{ route($r.'.index') }}" class="sidebar-link {{ request()->routeIs($r.'.*') ? 'active' : '' }}" style="padding-left:22px;">
            <i class="bi {{ $d[0] }}"></i> {{ $d[1] }}
        </a>
        @endforeach
        @endif
    </div>
</nav>

{{-- Topbar --}}
<header id="topbar">
    <div class="d-flex align-items-center gap-2">
        <button class="btn btn-sm btn-light d-md-none" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        @isset($header)
        <span class="fw-semibold" style="font-size:14px;">{{ $header }}</span>
        @endisset
    </div>
    <div class="d-flex align-items-center gap-2">
        {{-- Avatar + Info --}}
        <div class="d-flex align-items-center gap-2">
            <div class="rounded-2 d-flex align-items-center justify-content-center text-white fw-bold"
                 style="width:30px;height:30px;background:#0d6efd;font-size:12px;">
                {{ strtoupper(substr(auth()->user()->name,0,1)) }}
            </div>
            <div class="d-none d-md-block" style="line-height:1.2;">
                <div style="font-size:13px;font-weight:600;">{{ auth()->user()->name }}</div>
                <div style="font-size:11px;color:#6C757D;text-transform:capitalize;">{{ auth()->user()->role }}</div>
            </div>
        </div>
        {{-- Profile --}}
        <a href="{{ route('profile.edit') }}" class="btn btn-sm btn-outline-secondary" title="Edit Profile">
            <i class="bi bi-person"></i>
        </a>
        {{-- Logout --}}
        <form method="POST" action="{{ route('logout') }}" class="m-0">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger" title="Logout">
                <i class="bi bi-box-arrow-right"></i>
            </button>
        </form>
    </div>
</header>

{{-- Main Content --}}
<div id="content-wrapper">
    <div id="main-content">
        {{-- Flash Messages --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>{{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{ $slot }}
    </div>
</div>

{{-- Bootstrap 5 JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Mobile sidebar toggle
    document.getElementById('sidebarToggle')?.addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('show');
    });
</script>
@stack('scripts')
</body>
</html>
