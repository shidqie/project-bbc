<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kasir (POS) — Warung BBC</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family:'Inter',sans-serif; background:#F8F9FA; overflow:hidden; height:100vh; }
        .pos-layout { display:flex; flex-direction:column; height:100vh; }
        .pos-topbar { height:52px; background:#fff; border-bottom:1px solid #DEE2E6; display:flex; align-items:center; justify-content:space-between; padding:0 16px; flex-shrink:0; }
        .pos-body { flex:1; display:flex; overflow:hidden; }
        .pos-products { flex:1; display:flex; flex-direction:column; overflow:hidden; padding:16px; gap:12px; }
        .pos-cart { width:340px; background:#fff; border-left:1px solid #DEE2E6; display:flex; flex-direction:column; flex-shrink:0; }

        .menu-card { cursor:pointer; transition:all .15s; border:1px solid #DEE2E6; border-radius:10px; overflow:hidden; background:#fff; }
        .menu-card:hover { box-shadow:0 4px 16px rgba(0,0,0,.1); transform:translateY(-2px); }
        .menu-card:active { transform:scale(.97); }
        .menu-card-img { aspect-ratio:4/3; background:#F8F9FA; overflow:hidden; }
        .menu-card-img img { width:100%; height:100%; object-fit:cover; }
        .menu-card-placeholder { width:100%; height:100%; display:flex; align-items:center; justify-content:center; color:#CED4DA; }
        .menu-grid { display:grid; grid-template-columns:repeat(auto-fill,minmax(130px,1fr)); gap:10px; }

        .cart-item { border-bottom:1px solid #F8F9FA; padding:10px 0; }
        .cart-item:last-child { border-bottom:none; }

        ::-webkit-scrollbar { width:4px; }
        ::-webkit-scrollbar-thumb { background:#DEE2E6; border-radius:99px; }
    </style>
</head>
<body>
<div class="pos-layout">

    {{-- Topbar --}}
    <div class="pos-topbar">
        <div class="d-flex align-items-center gap-2">
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary">
                <i class="bi bi-arrow-left"></i>
            </a>
            <span class="fw-bold" style="font-size:15px;">Warung BBC</span>
            <span class="badge bg-primary">POS</span>
        </div>
        <div class="d-flex align-items-center gap-3">
            <span id="live-clock" class="text-muted small"></span>
            <span class="fw-semibold small">{{ auth()->user()->name }}</span>
        </div>
    </div>

    <div class="pos-body">

        {{-- Products Panel --}}
        <div class="pos-products">

            {{-- Toolbar --}}
            <div class="d-flex gap-2 align-items-center flex-wrap">
                <div class="input-group" style="max-width:240px;">
                    <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                    <input type="text" id="search-input" class="form-control" placeholder="Cari menu…" oninput="applyFilter()">
                </div>
                <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-dark cat-btn active" id="cat-semua" onclick="setCategory('semua')">Semua</button>
                    <button class="btn btn-sm btn-outline-secondary cat-btn" id="cat-makanan" onclick="setCategory('makanan')">Makanan</button>
                    <button class="btn btn-sm btn-outline-secondary cat-btn" id="cat-minuman" onclick="setCategory('minuman')">Minuman</button>
                    <button class="btn btn-sm btn-outline-secondary cat-btn" id="cat-cemilan" onclick="setCategory('cemilan')">Cemilan</button>
                </div>
            </div>

            {{-- Grid --}}
            <div style="flex:1;overflow-y:auto;">
                <div class="menu-grid" id="menu-grid">
                    @foreach($menus as $menu)
                    <div class="menu-card"
                         data-kategori="{{ $menu->kategori }}"
                         data-nama="{{ strtolower($menu->nama) }}"
                         onclick="addToCart({{ $menu->id }},'{{ addslashes($menu->nama) }}',{{ $menu->harga }})">
                        <div class="menu-card-img">
                            @if($menu->gambar)
                                <img src="{{ asset('storage/'.$menu->gambar) }}" loading="lazy">
                            @else
                                <div class="menu-card-placeholder">
                                    <i class="bi bi-image fs-3"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-2">
                            <p class="mb-1 fw-semibold" style="font-size:12px;line-height:1.3;">{{ $menu->nama }}</p>
                            <p class="mb-0 fw-bold text-primary" style="font-size:13px;">Rp {{ number_format($menu->harga,0,',','.') }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Cart Panel --}}
        <div class="pos-cart">
            <form action="{{ route('pos.store') }}" method="POST" id="pos-form" style="display:flex;flex-direction:column;height:100%;">
                @csrf

                {{-- Cart Header --}}
                <div class="p-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="fw-bold">Pesanan</span>
                        <span id="cart-badge" class="badge bg-secondary rounded-pill">0 item</span>
                    </div>
                    <select name="meja_id" class="form-select form-select-sm" required>
                        <option value="">— Pilih Meja —</option>
                        @foreach($mejas as $meja)
                        <option value="{{ $meja->id }}">Meja {{ $meja->nomor }} · {{ $meja->kapasitas }} orang</option>
                        @endforeach
                    </select>
                </div>

                {{-- Items --}}
                <div id="cart-items" style="flex:1;overflow-y:auto;padding:0 16px;">
                    <div id="empty-cart" class="text-center text-muted py-5">
                        <i class="bi bi-cart fs-2 d-block mb-2"></i>
                        <small>Pilih menu untuk memulai</small>
                    </div>
                </div>

                {{-- Checkout --}}
                <div class="p-3 border-top">
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted small">Subtotal</span>
                        <span id="disp-subtotal" class="fw-semibold small">Rp 0</span>
                    </div>
                    <hr class="my-2">
                    <div class="d-flex justify-content-between mb-3">
                        <span class="fw-bold">Total</span>
                        <span id="disp-total" class="fw-bold fs-5 text-primary">Rp 0</span>
                    </div>

                    <div class="row g-2 mb-2">
                        <div class="col-6">
                            <label class="form-label small mb-1 text-muted">Metode</label>
                            <select name="metode_pembayaran" class="form-select form-select-sm">
                                <option value="tunai">Tunai</option>
                                <option value="transfer">QRIS / Transfer</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <label class="form-label small mb-1 text-muted">Uang Diterima</label>
                            <input type="number" name="jumlah_bayar" id="jumlah-bayar" class="form-control form-control-sm" oninput="calcChange()" required>
                        </div>
                    </div>

                    <div id="change-box" class="alert alert-success py-2 text-center d-none mb-2">
                        <small class="text-muted d-block">Kembalian</small>
                        <strong id="disp-change" class="text-success">Rp 0</strong>
                    </div>

                    <button type="submit" id="btn-pay" class="btn btn-primary w-100 fw-bold" disabled>
                        <i class="bi bi-cash-coin me-2"></i>PROSES PEMBAYARAN
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Clock
(function tick(){
    const n=new Date();
    document.getElementById('live-clock').textContent =
        n.toLocaleDateString('id-ID',{weekday:'short',day:'numeric',month:'short'})+' · '+
        n.toLocaleTimeString('id-ID',{hour:'2-digit',minute:'2-digit',second:'2-digit'});
    setTimeout(tick,1000);
})();

// Category filter
let activeCategory='semua';
function setCategory(cat){
    activeCategory=cat;
    document.querySelectorAll('.cat-btn').forEach(b=>{
        b.classList.remove('btn-dark','active','btn-outline-secondary');
        b.classList.add(b.id==='cat-'+cat?'btn-dark':'btn-outline-secondary');
        if(b.id==='cat-'+cat) b.classList.add('active');
    });
    applyFilter();
}
function applyFilter(){
    const q=document.getElementById('search-input').value.toLowerCase().trim();
    document.querySelectorAll('.menu-card').forEach(c=>{
        const okCat=activeCategory==='semua'||c.dataset.kategori===activeCategory;
        const okQ=!q||c.dataset.nama.includes(q);
        c.style.display=okCat&&okQ?'block':'none';
    });
}

// Cart
const cart={};
let total=0;
function addToCart(id,nama,harga){
    cart[id]?cart[id].qty++:(cart[id]={id,nama,harga,qty:1});
    render();
}
function setQty(id,delta){
    if(!cart[id])return;
    cart[id].qty+=delta;
    if(cart[id].qty<=0)delete cart[id];
    render();
}
function removeItem(id){delete cart[id];render();}

function render(){
    const container=document.getElementById('cart-items');
    const empty=document.getElementById('empty-cart');
    const badge=document.getElementById('cart-badge');
    const btnPay=document.getElementById('btn-pay');
    const keys=Object.keys(cart);
    total=0; let count=0;

    container.innerHTML='';
    if(keys.length===0){
        container.appendChild(empty||(() => { const d=document.createElement('div'); d.id='empty-cart'; d.className='text-center text-muted py-5'; d.innerHTML='<i class="bi bi-cart fs-2 d-block mb-2"></i><small>Pilih menu untuk memulai</small>'; return d; })());
        // rebuild empty div
        const empty2=document.createElement('div');
        empty2.id='empty-cart'; empty2.className='text-center text-muted py-5';
        empty2.innerHTML='<i class="bi bi-cart fs-2 d-block mb-2"></i><small>Pilih menu untuk memulai</small>';
        container.appendChild(empty2);
        btnPay.disabled=true;
    } else {
        keys.forEach(k=>{
            const it=cart[k]; const sub=it.harga*it.qty;
            total+=sub; count+=it.qty;
            const el=document.createElement('div');
            el.className='cart-item';
            el.innerHTML=`
                <div class="d-flex justify-content-between align-items-start mb-1">
                    <span class="fw-semibold" style="font-size:12px;flex:1;">${it.nama}</span>
                    <button type="button" onclick="removeItem(${it.id})" class="btn-close btn-close-sm ms-2" style="font-size:8px;"></button>
                </div>
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-2">
                        <button type="button" onclick="setQty(${it.id},-1)" class="btn btn-sm btn-outline-secondary" style="width:24px;height:24px;padding:0;line-height:1;">−</button>
                        <span class="fw-bold small">${it.qty}</span>
                        <button type="button" onclick="setQty(${it.id},1)" class="btn btn-sm btn-outline-secondary" style="width:24px;height:24px;padding:0;line-height:1;">+</button>
                    </div>
                    <span class="fw-bold small text-primary">Rp ${sub.toLocaleString('id-ID')}</span>
                </div>
                <input type="hidden" name="menu_id[]" value="${it.id}">
                <input type="hidden" name="qty[]" value="${it.qty}">`;
            container.appendChild(el);
        });
        btnPay.disabled=false;
    }

    badge.textContent=count+' item';
    const fmt=v=>'Rp '+v.toLocaleString('id-ID');
    document.getElementById('disp-subtotal').textContent=fmt(total);
    document.getElementById('disp-total').textContent=fmt(total);
    document.getElementById('jumlah-bayar').value=total>0?total:'';
    calcChange();
}

function calcChange(){
    const bayar=parseInt(document.getElementById('jumlah-bayar').value)||0;
    const box=document.getElementById('change-box');
    const disp=document.getElementById('disp-change');
    if(bayar>total&&total>0){
        disp.textContent='Rp '+(bayar-total).toLocaleString('id-ID');
        box.classList.remove('d-none');
    } else { box.classList.add('d-none'); }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
