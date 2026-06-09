@php
$lapTabs = [
    'laporan.penjualan' => 'Penjualan',
    'laporan.catering'  => 'Catering',
    'laporan.nasibox'   => 'Nasi Box',
    'laporan.persediaan'=> 'Persediaan',
    'laporan.pengadaan' => 'Pengadaan',
];
$currentTab = request()->route()->getName();
@endphp
<ul class="nav nav-tabs mb-4">
    @foreach($lapTabs as $route => $label)
    <li class="nav-item">
        <a class="nav-link {{ $currentTab === $route ? 'active fw-semibold' : '' }}" href="{{ route($route) }}">{{ $label }}</a>
    </li>
    @endforeach
</ul>
