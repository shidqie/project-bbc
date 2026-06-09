{{-- Sidebar --}}
<aside :class="open ? 'translate-x-0' : '-translate-x-full'"
    style="width:220px;background:#fff;border-right:1px solid #EBEBEB;display:flex;flex-direction:column;transition:transform .25s ease;z-index:30;"
    class="fixed inset-y-0 left-0 lg:static lg:translate-x-0 shrink-0">

    {{-- Logo --}}
    <div style="height:56px;border-bottom:1px solid #EBEBEB;padding:0 20px;" class="flex items-center gap-2.5">
        <div style="width:26px;height:26px;background:#111;border-radius:6px;display:flex;align-items:center;justify-content:center;">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.871c1.355 0 2.697.056 4.024.166C17.155 8.51 18 9.473 18 10.608v2.513M15 8.25v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75"/></svg>
        </div>
        <span style="font-size:14px;font-weight:700;color:#111;letter-spacing:-0.3px;">Warung BBC</span>
    </div>

    {{-- Nav --}}
    <nav style="padding:12px 10px;flex:1;overflow-y:auto;">

        <a href="{{ route('dashboard') }}"
            class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/></svg>
            Dashboard
        </a>

        @if(in_array(auth()->user()->role, ['pemilik','manager','kasir']))
        <a href="{{ route('pos.index') }}" class="nav-item mt-0.5">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 013.75 9.375v-4.5zM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 01-1.125-1.125v-4.5zM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0113.5 9.375v-4.5z"/><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75zM6.75 16.5h.75v.75h-.75V16.5zM16.5 6.75h.75v.75h-.75v-.75zM13.5 13.5h.75v.75h-.75v-.75zM13.5 19.5h.75v.75h-.75v-.75zM19.5 13.5h.75v.75h-.75v-.75zM19.5 19.5h.75v.75h-.75v-.75zM16.5 16.5h.75v.75h-.75v-.75z"/></svg>
            Kasir (POS)
        </a>
        @endif

        @if(in_array(auth()->user()->role, ['pemilik','manager']))
        <p style="font-size:10px;font-weight:600;color:#BBB;letter-spacing:.08em;text-transform:uppercase;padding:16px 12px 6px;">Laporan</p>

        @php $laporanLinks = [
            ['r'=>'laporan.penjualan','l'=>'Penjualan'],
            ['r'=>'laporan.catering','l'=>'Catering'],
            ['r'=>'laporan.nasibox','l'=>'Nasi Box'],
            ['r'=>'laporan.persediaan','l'=>'Persediaan'],
            ['r'=>'laporan.pengadaan','l'=>'Pengadaan'],
        ]; @endphp
        @foreach($laporanLinks as $m)
        <a href="{{ route($m['r']) }}" class="nav-item {{ request()->routeIs($m['r']) ? 'active' : '' }}">
            <div style="width:4px;height:4px;border-radius:50%;background:currentColor;margin-left:4px;"></div>
            {{ $m['l'] }}
        </a>
        @endforeach
        @endif

        @if(in_array(auth()->user()->role, ['pemilik','manager','dapur','pelayan']))
        <p style="font-size:10px;font-weight:600;color:#BBB;letter-spacing:.08em;text-transform:uppercase;padding:16px 12px 6px;">Operasional</p>

        <a href="{{ route('pesanan-catering.index') }}"
            class="nav-item {{ request()->routeIs('pesanan-catering.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z"/></svg>
            Catering
        </a>
        <a href="{{ route('pesanan-nasibox.index') }}"
            class="nav-item {{ request()->routeIs('pesanan-nasibox.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M21 11.25v8.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 109.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1114.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z"/></svg>
            Nasi Box
        </a>
        @endif

        @if(in_array(auth()->user()->role, ['pemilik','manager']))
        <a href="{{ route('pengadaan.index') }}"
            class="nav-item {{ request()->routeIs('pengadaan.*') ? 'active' : '' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="1.8" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0l-3-3m3 3l3-3M3.75 7.5h16.5M8.625 7.5a.375.375 0 11-.75 0 .375.375 0 01.75 0zm7.5 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z"/></svg>
            Pengadaan
        </a>

        <p style="font-size:10px;font-weight:600;color:#BBB;letter-spacing:.08em;text-transform:uppercase;padding:16px 12px 6px;">Master Data</p>

        @php $masterLinks = [
            ['r'=>'menu','l'=>'Menu'],['r'=>'bahan-baku','l'=>'Bahan Baku'],
            ['r'=>'paket-catering','l'=>'Paket Catering'],['r'=>'paket-nasibox','l'=>'Nasi Box'],
            ['r'=>'pelanggan','l'=>'Pelanggan'],['r'=>'supplier','l'=>'Supplier'],
            ['r'=>'meja','l'=>'Meja'],
        ]; @endphp

        @foreach($masterLinks as $m)
        <a href="{{ route($m['r'].'.index') }}"
            class="nav-item {{ request()->routeIs($m['r'].'.*') ? 'active' : '' }}">
            <div style="width:4px;height:4px;border-radius:50%;background:currentColor;margin-left:4px;"></div>
            {{ $m['l'] }}
        </a>
        @endforeach
        @endif

    </nav>
</aside>
