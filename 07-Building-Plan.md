# 07-Building-Plan.md

# DEVELOPMENT BUILDING PLAN

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# DEVELOPMENT STRATEGY

Metode pengembangan menggunakan:

Module Based Development

Setiap modul harus:

Build
↓
Test
↓
Review
↓
Deploy Next Module

---

# PHASE 1 - PROJECT SETUP

## Objective

Menyiapkan fondasi aplikasi.

## Task

* Install Laravel 11
* Install Laravel Breeze
* Setup Bootstrap 5
* Setup Database MySQL
* Setup Git Repository

## Deliverable

* Laravel Project Ready
* Authentication Ready

## Estimasi

1 Hari

---

# PHASE 2 - AUTHENTICATION

## Objective

Membangun autentikasi dan hak akses.

## Task

* Login
* Logout
* Role Middleware
* User Seeder

## Deliverable

* Authentication Module

## Estimasi

1 Hari

---

# PHASE 3 - DATABASE FOUNDATION

## Objective

Membangun struktur database.

## Task

* Migration
* Foreign Key
* Seeder
* Factory

## Deliverable

* Database Schema Implemented

## Estimasi

1 Hari

---

# PHASE 4 - MASTER DATA MODULE

## Objective

Mengelola seluruh data master.

## Modul

* Menu
* Paket Catering
* Paket Nasi Box
* Supplier
* Pelanggan
* Bahan Baku
* Meja
* Komposisi Menu

## Deliverable

* Master Data Complete

## Estimasi

2 Hari

---

# PHASE 5 - POS DINE-IN MODULE

## Objective

Membangun sistem kasir.

## Flow

Kasir
↓
Pilih Meja
↓
Pilih Menu
↓
Simpan Transaksi
↓
Pembayaran
↓
Cetak Struk

## Deliverable

* POS Complete

## Estimasi

2 Hari

---

# PHASE 6 - INVENTORY ENGINE

## Objective

Membangun stok otomatis.

## Flow

Transaksi
↓
Detail Transaksi
↓
Komposisi Menu
↓
Bahan Baku
↓
Update Stok

## Deliverable

* Inventory Engine Complete

## Estimasi

2 Hari

---

# PHASE 7 - CATERING MODULE

## Objective

Mengelola pesanan catering.

## Fitur

* Input Pesanan
* Konfirmasi
* Produksi
* Pengiriman
* Status

## Deliverable

* Catering Module Complete

## Estimasi

2 Hari

---

# PHASE 8 - NASI BOX MODULE

## Objective

Mengelola pesanan nasi box.

## Fitur

* Input Pesanan
* Produksi
* Pengiriman
* Status

## Deliverable

* Nasi Box Module Complete

## Estimasi

1 Hari

---

# PHASE 9 - PROCUREMENT MODULE

## Objective

Mengelola pengadaan bahan baku.

## Catering Procurement

Pesanan Catering
↓
Generate Kebutuhan Bahan
↓
Generate PDF

## Operational Procurement

Stok Minimum
↓
Generate Daftar Pembelian

## Receiving Goods

Barang Datang
↓
Update Stok

## Deliverable

* Procurement Complete

## Estimasi

2 Hari

---

# PHASE 10 - DASHBOARD MODULE

## Objective

Membangun dashboard monitoring.

## Widget

* Total Penjualan
* Total Transaksi
* Produk Terlaris
* Catering Aktif
* Nasi Box Aktif
* Stok Menipis

## Deliverable

* Dashboard Complete

## Estimasi

1 Hari

---

# PHASE 11 - REPORTING MODULE

## Objective

Membangun laporan.

## Laporan

* Penjualan
* Catering
* Nasi Box
* Persediaan
* Pengadaan

## Export

* PDF
* Print

## Deliverable

* Reporting Complete

## Estimasi

2 Hari

---

# PHASE 12 - TESTING

## Objective

Memastikan seluruh modul berjalan.

## Testing

* Authentication
* Master Data
* POS
* Inventory
* Catering
* Nasi Box
* Procurement
* Reporting

## Deliverable

* Bug Fixing
* Stable Build

## Estimasi

2 Hari

---

# PHASE 13 - DEPLOYMENT

## Objective

Publikasi aplikasi.

## Task

* Setup Hosting
* Setup Database Production
* Security Configuration
* Backup Strategy

## Deliverable

* Production Ready Application

## Estimasi

1 Hari

---

# TOTAL ESTIMATION

| Phase | Modul          | Hari |
| ----- | -------------- | ---- |
| 1     | Setup          | 1    |
| 2     | Authentication | 1    |
| 3     | Database       | 1    |
| 4     | Master Data    | 2    |
| 5     | POS            | 2    |
| 6     | Inventory      | 2    |
| 7     | Catering       | 2    |
| 8     | Nasi Box       | 1    |
| 9     | Procurement    | 2    |
| 10    | Dashboard      | 1    |
| 11    | Reporting      | 2    |
| 12    | Testing        | 2    |
| 13    | Deployment     | 1    |

Total Estimasi: 20 Hari Kerja
