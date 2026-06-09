<x-public-layout>
    <x-slot name="title">Pesan Catering</x-slot>
    <section class="py-5 mt-2">
        <div class="container py-3" style="max-width:720px;">
            <div class="text-center mb-5" data-aos="fade-up">
                <span class="badge-kategori mb-3 d-inline-block">Form Pemesanan</span>
                <h1 class="section-title">Pesan Catering</h1>
                <p class="section-sub">Isi data berikut, kami akan segera konfirmasi pesanan Anda</p>
            </div>

            @if($errors->any())
            <div class="alert alert-danger rounded-3 mb-4">
                <ul class="mb-0 ps-3">
                    @foreach($errors->all() as $errMsg)
                    <li>{{ $errMsg }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card border-0 shadow-sm" data-aos="fade-up">
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('public.order.catering.store') }}" method="POST">
                        @csrf

                        <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color:var(--bbc-primary);">
                            <i class="bi bi-person me-2"></i>Data Pelanggan
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nama Lengkap <span class="text-danger">*</span></label>
                                <input type="text" name="nama" value="{{ old('nama') }}"
                                    class="form-control rounded-3{{ $errors->has('nama') ? ' is-invalid' : '' }}"
                                    placeholder="Nama Anda">
                                <div class="invalid-feedback">{{ $errors->first('nama') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Nomor Telepon / WhatsApp <span class="text-danger">*</span></label>
                                <input type="text" name="telepon" value="{{ old('telepon') }}"
                                    class="form-control rounded-3{{ $errors->has('telepon') ? ' is-invalid' : '' }}"
                                    placeholder="08xx-xxxx-xxxx">
                                <div class="invalid-feedback">{{ $errors->first('telepon') }}</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Alamat <span class="text-danger">*</span></label>
                                <textarea name="alamat" rows="2"
                                    class="form-control rounded-3{{ $errors->has('alamat') ? ' is-invalid' : '' }}"
                                    placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                                <div class="invalid-feedback">{{ $errors->first('alamat') }}</div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color:var(--bbc-primary);">
                            <i class="bi bi-calendar-event me-2"></i>Data Acara
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Tanggal Acara <span class="text-danger">*</span></label>
                                <input type="date" name="tanggal_acara" value="{{ old('tanggal_acara') }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="form-control rounded-3{{ $errors->has('tanggal_acara') ? ' is-invalid' : '' }}">
                                <div class="invalid-feedback">{{ $errors->first('tanggal_acara') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Lokasi Acara <span class="text-danger">*</span></label>
                                <input type="text" name="lokasi_acara" value="{{ old('lokasi_acara') }}"
                                    class="form-control rounded-3{{ $errors->has('lokasi_acara') ? ' is-invalid' : '' }}"
                                    placeholder="Gedung / Rumah / dll">
                                <div class="invalid-feedback">{{ $errors->first('lokasi_acara') }}</div>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 pb-2 border-bottom" style="color:var(--bbc-primary);">
                            <i class="bi bi-journal-text me-2"></i>Data Pesanan
                        </h6>
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Paket Catering <span class="text-danger">*</span></label>
                                <select name="paket_catering_id"
                                    class="form-select rounded-3{{ $errors->has('paket_catering_id') ? ' is-invalid' : '' }}"
                                    id="paket-select" onchange="updateHarga()">
                                    <option value="">— Pilih Paket —</option>
                                    @foreach($pakets as $p)
                                    <option value="{{ $p->id }}"
                                        data-harga="{{ $p->harga }}"
                                        data-min="{{ $p->minimum_order ?? 1 }}"
                                        {{ (old('paket_catering_id') == $p->id || $selectedId == $p->id) ? 'selected' : '' }}>
                                        {{ $p->nama }} — Rp {{ number_format($p->harga,0,',','.') }}/porsi
                                    </option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">{{ $errors->first('paket_catering_id') }}</div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold small">Jumlah Porsi <span class="text-danger">*</span></label>
                                <input type="number" name="qty" value="{{ old('qty', 1) }}" min="1"
                                    id="qty-input"
                                    class="form-control rounded-3{{ $errors->has('qty') ? ' is-invalid' : '' }}"
                                    oninput="updateHarga()">
                                <div class="invalid-feedback">{{ $errors->first('qty') }}</div>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-semibold small">Catatan Tambahan</label>
                                <textarea name="catatan" rows="2" class="form-control rounded-3"
                                    placeholder="Alergi, preferensi menu, permintaan khusus...">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        <div id="harga-preview" class="alert d-none rounded-3 mb-4"
                            style="background:#ECFDF5;border:1px solid #BBF7D0;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-semibold" style="color:#15803D;">Estimasi Total</span>
                                <span id="harga-total" class="fw-black fs-5" style="color:var(--bbc-primary);">Rp 0</span>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-bbc btn-lg w-100 rounded-3 fw-bold">
                            <i class="bi bi-send me-2"></i>Kirim Pesanan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
    function updateHarga(){
        const sel = document.getElementById('paket-select');
        const opt = sel.options[sel.selectedIndex];
        const qty = parseInt(document.getElementById('qty-input').value)||0;
        const harga = parseInt(opt.dataset.harga)||0;
        const preview = document.getElementById('harga-preview');
        if(harga && qty){
            document.getElementById('harga-total').textContent='Rp '+(harga*qty).toLocaleString('id-ID');
            preview.classList.remove('d-none');
        } else { preview.classList.add('d-none'); }
    }
    document.addEventListener('DOMContentLoaded', updateHarga);
    </script>
</x-public-layout>
