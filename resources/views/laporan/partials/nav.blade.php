@php
$navItems = ['penjualan'=>'Penjualan','catering'=>'Catering','nasibox'=>'Nasi Box','persediaan'=>'Persediaan','pengadaan'=>'Pengadaan'];
$currentRoute = request()->route()->getName();
$currentTab = str_replace('laporan.','',$currentRoute);
@endphp

@php function laporanNav() { return ['penjualan'=>'Penjualan','catering'=>'Catering','nasibox'=>'Nasi Box','persediaan'=>'Persediaan','pengadaan'=>'Pengadaan']; } @endphp

<div style="display:flex;gap:8px;margin-bottom:20px;flex-wrap:wrap;">
    @foreach($navItems as $key=>$label)
    <a href="{{ route('laporan.'.$key) }}" style="font-size:12px;font-weight:600;padding:6px 14px;border-radius:8px;text-decoration:none;
        {{ $currentTab===$key ? 'background:#111;color:#fff;' : 'background:#F5F5F5;color:#666;' }}">
        {{ $label }}
    </a>
    @endforeach
</div>
