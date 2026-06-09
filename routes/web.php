<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── PUBLIC WEBSITE (08-Frontend-Website.md) ─────────────────────────────────
Route::get('/', [\App\Http\Controllers\PublicController::class, 'home'])->name('public.home');
Route::get('/about', [\App\Http\Controllers\PublicController::class, 'about'])->name('public.about');
Route::get('/menus', [\App\Http\Controllers\PublicController::class, 'menus'])->name('public.menus');
Route::get('/catering', [\App\Http\Controllers\PublicController::class, 'cateringIndex'])->name('public.catering');
Route::get('/catering/{id}', [\App\Http\Controllers\PublicController::class, 'cateringShow'])->name('public.catering.show');
Route::get('/nasi-box', [\App\Http\Controllers\PublicController::class, 'nasiboxIndex'])->name('public.nasibox');
Route::get('/nasi-box/{id}', [\App\Http\Controllers\PublicController::class, 'nasiboxShow'])->name('public.nasibox.show');
Route::get('/order/catering', [\App\Http\Controllers\PublicController::class, 'orderCateringForm'])->name('public.order.catering');
Route::post('/order/catering', [\App\Http\Controllers\PublicController::class, 'orderCateringStore'])->name('public.order.catering.store');
Route::get('/order/nasi-box', [\App\Http\Controllers\PublicController::class, 'orderNasiboxForm'])->name('public.order.nasibox');
Route::post('/order/nasi-box', [\App\Http\Controllers\PublicController::class, 'orderNasiboxStore'])->name('public.order.nasibox.store');
Route::get('/tracking', [\App\Http\Controllers\PublicController::class, 'tracking'])->name('public.tracking');
Route::get('/contact', [\App\Http\Controllers\PublicController::class, 'contact'])->name('public.contact');

// ─── Dashboard ────────────────────────────────────────────────────────────────
// TRD: Kasir ✓ (dashboard kasir), Manager ✓, Pemilik ✓
Route::middleware('auth')->get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

// ─── Member Dashboard (Konsumen) ──────────────────────────────────────────────
Route::middleware(['auth', 'role:konsumen'])->group(function () {
    Route::get('/member/dashboard', [\App\Http\Controllers\MemberController::class, 'dashboard'])->name('member.dashboard');
});

// ─── Profile (semua role) ─────────────────────────────────────────────────────
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ─── POS Dine-In ──────────────────────────────────────────────────────────────
// TRD: Kasir ✓, Pemilik ✓ | Tim Dapur: View only
Route::middleware(['auth', 'role:kasir,pemilik'])->group(function () {
    Route::get('/pos', [\App\Http\Controllers\PosController::class, 'index'])->name('pos.index');
    Route::post('/pos', [\App\Http\Controllers\PosController::class, 'store'])->name('pos.store');
});
Route::middleware('auth')->get('/pos/receipt/{id}', [\App\Http\Controllers\PosController::class, 'receipt'])->name('pos.receipt');

// ─── Pesanan Catering ─────────────────────────────────────────────────────────
// TRD: Pemilik ✓ (CRUD + status), Tim Dapur/Pelayan: view only
Route::middleware('auth')->group(function () {
    // View — dapur, pelayan, pemilik, manager
    Route::get('/pesanan-catering', [\App\Http\Controllers\PesananCateringController::class, 'index'])->name('pesanan-catering.index');
    Route::get('/pesanan-catering/{id}', [\App\Http\Controllers\PesananCateringController::class, 'show'])->name('pesanan-catering.show');
    Route::get('/pesanan-catering/{id}/kebutuhan-bahan', [\App\Http\Controllers\PesananCateringController::class, 'kebutuhanBahan'])->name('pesanan-catering.kebutuhanBahan');
});
Route::middleware(['auth', 'role:pemilik,manager'])->group(function () {
    Route::get('/pesanan-catering/create', [\App\Http\Controllers\PesananCateringController::class, 'create'])->name('pesanan-catering.create');
    Route::post('/pesanan-catering', [\App\Http\Controllers\PesananCateringController::class, 'store'])->name('pesanan-catering.store');
    Route::patch('/pesanan-catering/{id}/status', [\App\Http\Controllers\PesananCateringController::class, 'updateStatus'])->name('pesanan-catering.updateStatus');
});

// ─── Pesanan Nasi Box ─────────────────────────────────────────────────────────
// TRD: Pemilik ✓ (CRUD + status), Tim Dapur/Pelayan: view only
Route::middleware('auth')->group(function () {
    Route::get('/pesanan-nasibox', [\App\Http\Controllers\PesananNasiboxController::class, 'index'])->name('pesanan-nasibox.index');
    Route::get('/pesanan-nasibox/{id}', [\App\Http\Controllers\PesananNasiboxController::class, 'show'])->name('pesanan-nasibox.show');
});
Route::middleware(['auth', 'role:pemilik,manager'])->group(function () {
    Route::get('/pesanan-nasibox/create', [\App\Http\Controllers\PesananNasiboxController::class, 'create'])->name('pesanan-nasibox.create');
    Route::post('/pesanan-nasibox', [\App\Http\Controllers\PesananNasiboxController::class, 'store'])->name('pesanan-nasibox.store');
    Route::patch('/pesanan-nasibox/{id}/status', [\App\Http\Controllers\PesananNasiboxController::class, 'updateStatus'])->name('pesanan-nasibox.updateStatus');
});

// ─── Pengadaan ────────────────────────────────────────────────────────────────
// TRD: Pemilik ✓ only
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::get('/pengadaan', [\App\Http\Controllers\PengadaanController::class, 'index'])->name('pengadaan.index');
    Route::get('/pengadaan/create', [\App\Http\Controllers\PengadaanController::class, 'create'])->name('pengadaan.create');
    Route::post('/pengadaan', [\App\Http\Controllers\PengadaanController::class, 'store'])->name('pengadaan.store');
    Route::get('/pengadaan/{id}', [\App\Http\Controllers\PengadaanController::class, 'show'])->name('pengadaan.show');
    Route::patch('/pengadaan/{id}/status', [\App\Http\Controllers\PengadaanController::class, 'updateStatus'])->name('pengadaan.updateStatus');
    Route::get('/pengadaan/{id}/pdf', [\App\Http\Controllers\PengadaanController::class, 'exportPdf'])->name('pengadaan.pdf');
});

// ─── Master Data ──────────────────────────────────────────────────────────────
// TRD: Pemilik ✓ only | Manager & Tim Dapur: view bahan baku only
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::resource('pelanggan', App\Http\Controllers\PelangganController::class);
    Route::resource('supplier', App\Http\Controllers\SupplierController::class);
    Route::resource('meja', App\Http\Controllers\MejaController::class);
    Route::resource('menu', App\Http\Controllers\MenuController::class);
    Route::resource('paket-catering', App\Http\Controllers\PaketCateringController::class);
    Route::resource('paket-nasibox', App\Http\Controllers\PaketNasiboxController::class);
});

// Bahan Baku — Pemilik full, Manager & Dapur view
Route::middleware(['auth', 'role:pemilik'])->group(function () {
    Route::resource('bahan-baku', App\Http\Controllers\BahanBakuController::class);
});

// ─── Laporan ──────────────────────────────────────────────────────────────────
// TRD: Manager ✓, Pemilik ✓
Route::middleware(['auth', 'role:pemilik,manager'])->group(function () {
    Route::get('/laporan', [App\Http\Controllers\LaporanController::class, 'penjualan'])->name('laporan.index');
    Route::get('/laporan/penjualan', [App\Http\Controllers\LaporanController::class, 'penjualan'])->name('laporan.penjualan');
    Route::get('/laporan/catering', [App\Http\Controllers\LaporanController::class, 'catering'])->name('laporan.catering');
    Route::get('/laporan/nasibox', [App\Http\Controllers\LaporanController::class, 'nasibox'])->name('laporan.nasibox');
    Route::get('/laporan/persediaan', [App\Http\Controllers\LaporanController::class, 'persediaan'])->name('laporan.persediaan');
    Route::get('/laporan/pengadaan', [App\Http\Controllers\LaporanController::class, 'pengadaan'])->name('laporan.pengadaan');
});

require __DIR__.'/auth.php';
