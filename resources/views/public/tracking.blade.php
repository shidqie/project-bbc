<x-public-layout>
    <x-slot name="title">Tracking Pesanan</x-slot>
    <section class="py-5 mt-2">
        <div class="container py-3" style="max-width:640px;">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Status Pesanan</span>
                <h1 class="section-title">Tracking Pesanan</h1>
                <p class="section-sub">Masukkan nomor pesanan untuk melihat status</p>
            </div>

            <div class="card border-0 shadow-sm mb-4" data-aos="fade-up">
                <div class="card-body p-4">
                    <form method="GET" action="{{ route('public.tracking') }}">
                        <label class="form-label fw-semibold">Nomor Pesanan</label>
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                            <input type="text" name="nomor" value="{{ $nomorPesanan }}"
                                   class="form-control rounded-end-3" placeholder="CA-0001 atau NB-0001"
                                   style="border-left:0;">
                            <button type="submit" class="btn btn-bbc rounded-3 ms-2 px-4">Cari</button>
                        </div>
                        <p class="text-muted small mt-2"><i class="bi bi-info-circle me-1"></i>Nomor pesanan dikirimkan setelah Anda memesan.</p>
                    </form>
                </div>
            </div>

            @if($nomorPesanan && !$pesanan)
            <div class="alert alert-warning rounded-3" data-aos="fade-up">
                <i class="bi bi-exclamation-triangle me-2"></i>Pesanan dengan nomor <strong>{{ $nomorPesanan }}</strong> tidak ditemukan.
            </div>
            @endif

            @if($pesanan)
            @php
            $statusCatering = ['menunggu_konfirmasi','terkonfirmasi','diproduksi','dikirim','selesai'];
            $statusNasibox  = ['diproses','dikirim','selesai'];
            $steps = $jenis==='catering' ? $statusCatering : $statusNasibox;
            $labelMap = [
                'menunggu_konfirmasi' => ['label'=>'Menunggu Konfirmasi','icon'=>'bi-clock'],
                'terkonfirmasi'       => ['label'=>'Terkonfirmasi','icon'=>'bi-check-circle'],
                'diproduksi'          => ['label'=>'Diproduksi','icon'=>'bi-fire'],
                'dikirim'             => ['label'=>'Dikirim','icon'=>'bi-truck'],
                'selesai'             => ['label'=>'Selesai','icon'=>'bi-bag-check'],
                'diproses'            => ['label'=>'Diproses','icon'=>'bi-gear'],
                'dibatalkan'          => ['label'=>'Dibatalkan','icon'=>'bi-x-circle'],
            ];
            $currentIdx = array_search($pesanan->status, $steps);
            @endphp
            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start mb-4">
                        <div>
                            <h5 class="fw-bold mb-1">{{ strtoupper($jenis==='catering'?'CA':'NB') }}-{{ str_pad($pesanan->id,4,'0',STR_PAD_LEFT) }}</h5>
                            <p class="text-muted small mb-0">{{ $pesanan->pelanggan->nama ?? '' }} · {{ $jenis==='catering' ? $pesanan->paketCatering->nama ?? '' : $pesanan->paketNasibox->nama ?? '' }}</p>
                        </div>
                        <div class="text-end">
                            <div class="fw-bold text-primary">Rp {{ number_format($pesanan->total_harga,0,',','.') }}</div>
                            <div class="text-muted small">{{ $pesanan->qty }} {{ $jenis==='catering'?'porsi':'box' }}</div>
                        </div>
                    </div>
                    <hr>
                    <h6 class="fw-semibold mb-4">Status Pesanan</h6>

                    @if($pesanan->status === 'dibatalkan')
                    <div class="alert alert-danger"><i class="bi bi-x-circle me-2"></i>Pesanan ini telah dibatalkan.</div>
                    @else
                    <div class="d-flex flex-column gap-4">
                        @foreach($steps as $idx => $s)
                        @php
                        $done   = $currentIdx !== false && $idx < $currentIdx;
                        $active = $s === $pesanan->status;
                        $info   = $labelMap[$s];
                        @endphp
                        <div class="step">
                            <div class="step-icon {{ $active?'step-active':($done?'step-done':'step-pending') }}">
                                <i class="bi {{ $info['icon'] }}"></i>
                            </div>
                            <div class="pt-1">
                                <p class="fw-{{ $active?'bold':'semibold' }} mb-0 {{ $active?'text-dark':'text-muted' }}" style="font-size:14px;">
                                    {{ $info['label'] }}
                                    @if($active)<span class="badge ms-2 rounded-pill" style="background:var(--bbc-primary);font-size:10px;">Sekarang</span>@endif
                                </p>
                                @if($done)<p class="text-success small mb-0">✓ Selesai</p>@endif
                                @if(!$done && !$active)<p class="text-muted small mb-0">Menunggu...</p>@endif
                            </div>
                        </div>
                        @if(!$loop->last)
                        <div style="margin-left:18px;width:2px;height:20px;background:#E5E7EB;margin-top:-20px;margin-bottom:-20px;"></div>
                        @endif
                        @endforeach
                    </div>
                    @endif

                    <hr class="mt-4">
                    <p class="text-muted small mb-0 text-center">
                        <i class="bi bi-telephone me-1"></i>Hubungi kami di <strong>+62 812-3456-7890</strong> untuk info lebih lanjut.
                    </p>
                </div>
            </div>
            @endif
        </div>
    </section>
</x-public-layout>
