# 05-Architecture.md

# SYSTEM ARCHITECTURE

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. ARCHITECTURE OVERVIEW

Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web dibangun menggunakan arsitektur three-tier architecture yang terdiri dari:

```text
Presentation Layer
Business Logic Layer
Data Layer
```

Arsitektur ini dipilih karena memudahkan pengembangan, pemeliharaan, serta pengujian sistem.

---

# 2. HIGH LEVEL ARCHITECTURE

```text
┌─────────────────────────┐
│         USER            │
├─────────────────────────┤
│ Kasir                   │
│ Tim Dapur               │
│ Manager                 │
│ Pemilik                 │
└───────────┬─────────────┘
            │
            ▼
┌─────────────────────────┐
│      WEB BROWSER        │
│ Chrome / Edge / Firefox │
└───────────┬─────────────┘
            │
            ▼
┌─────────────────────────┐
│   LARAVEL APPLICATION   │
├─────────────────────────┤
│ Authentication Module   │
│ Master Data Module      │
│ POS Module              │
│ Catering Module         │
│ Nasi Box Module         │
│ Inventory Module        │
│ Procurement Module      │
│ Dashboard Module        │
│ Reporting Module        │
└───────────┬─────────────┘
            │
            ▼
┌─────────────────────────┐
│      MYSQL DATABASE     │
└─────────────────────────┘
```

---

# 3. TECHNOLOGY ARCHITECTURE

## Backend Layer

Framework:

```text
Laravel 11
```

Bahasa Pemrograman:

```text
PHP 8.2+
```

Tanggung Jawab:

* Business Logic
* Authentication
* Authorization
* Database Access
* Validation
* Reporting

---

## Frontend Layer

Framework:

```text
Blade Template
Bootstrap 5
Javascript
```

Tanggung Jawab:

* User Interface
* Form Input
* Dashboard
* Data Table
* Reporting View

---

## Database Layer

Database:

```text
MySQL 8
```

Tanggung Jawab:

* Penyimpanan Data
* Relasi Data
* Integritas Data

---

# 4. LAYER ARCHITECTURE

Sistem menggunakan pola:

```text
Presentation Layer
        │
        ▼
Controller Layer
        │
        ▼
Service Layer
        │
        ▼
Repository Layer
        │
        ▼
Database Layer
```

---

# 5. PRESENTATION LAYER

## Fungsi

Menampilkan antarmuka pengguna.

## Teknologi

* Blade
* Bootstrap 5
* Javascript
* ChartJS

## Struktur

```text
resources/views

├── auth
├── dashboard
├── menu
├── supplier
├── pelanggan
├── bahan-baku
├── catering
├── nasibox
├── transaksi
├── pengadaan
├── laporan
└── layouts
```

---

# 6. CONTROLLER LAYER

## Fungsi

Menerima request dari pengguna.

Controller hanya menangani:

* Request
* Validation
* Response

Business logic tidak ditempatkan pada controller.

---

## Controller List

```text
AuthController

DashboardController

MenuController

SupplierController

PelangganController

BahanBakuController

PaketCateringController

PaketNasiBoxController

KomposisiMenuController

TransaksiController

PembayaranController

CateringController

NasiBoxController

PengadaanController

ReportController
```

---

# 7. SERVICE LAYER

## Fungsi

Menangani seluruh logika bisnis.

Service Layer dipilih agar:

* Controller tetap ringan
* Mudah di-maintain
* Mudah di-test

---

## Service List

### AuthenticationService

Mengelola:

* Login
* Logout
* Session

---

### InventoryService

Mengelola:

* Pengurangan stok
* Penambahan stok
* Monitoring stok

---

### CateringService

Mengelola:

* Pesanan catering
* Status catering

---

### NasiBoxService

Mengelola:

* Pesanan nasi box
* Status nasi box

---

### ProcurementService

Mengelola:

* Pengadaan catering
* Pengadaan operasional
* Receiving goods

---

### PaymentService

Mengelola:

* Pembayaran
* Validasi pembayaran

---

### DashboardService

Mengelola:

* Statistik dashboard

---

### ReportingService

Mengelola:

* Laporan
* Export PDF

---

# 8. REPOSITORY LAYER

## Fungsi

Mengelola akses database.

Repository bertanggung jawab terhadap:

* Query Database
* Insert Data
* Update Data
* Delete Data

---

## Repository List

```text
UserRepository

MenuRepository

SupplierRepository

PelangganRepository

BahanBakuRepository

CateringRepository

NasiBoxRepository

TransaksiRepository

PengadaanRepository

PembayaranRepository
```

---

# 9. MODULE ARCHITECTURE

## Authentication Module

Fitur:

* Login
* Logout
* Role Management

Role:

```text
Pemilik
Manager
Kasir
Tim Dapur
```

---

## Master Data Module

Fitur:

```text
Menu

Paket Catering

Paket Nasi Box

Bahan Baku

Supplier

Pelanggan

Meja

Komposisi Menu
```

---

## POS Module

Flow:

```text
Kasir
↓
Input Pesanan
↓
Simpan Transaksi
↓
Pembayaran
↓
Cetak Struk
```

---

## Catering Module

Flow:

```text
Input Pesanan
↓
Konfirmasi
↓
Generate Kebutuhan Bahan
↓
Produksi
↓
Pengiriman
↓
Selesai
```

---

## Nasi Box Module

Flow:

```text
Input Pesanan
↓
Produksi
↓
Pengiriman
↓
Selesai
```

---

## Inventory Module

Flow:

```text
Menu
↓
Komposisi Menu
↓
Bahan Baku
↓
Auto Stock Reduction
```

---

## Procurement Module

Flow:

```text
Pesanan Catering
↓
Generate Kebutuhan Bahan
↓
Generate Daftar Pembelian
↓
Supplier
↓
Receiving Goods
↓
Update Stok
```

---

## Dashboard Module

Widget:

```text
Total Penjualan

Total Transaksi

Catering Aktif

Nasi Box Aktif

Produk Terlaris

Stok Menipis
```

---

## Reporting Module

Output:

```text
PDF

Print
```

Laporan:

```text
Penjualan

Catering

Nasi Box

Persediaan

Pengadaan
```

---

# 10. INVENTORY ARCHITECTURE

## Konsep

Sistem menggunakan Bill of Material (BOM).

Contoh:

```text
Menu:
Ayam Penyet

Komposisi:

Ayam = 1
Beras = 0.2
Cabai = 0.05
```

Ketika:

```text
Ayam Penyet x 10
```

Maka sistem otomatis mengurangi:

```text
Ayam = 10

Beras = 2

Cabai = 0.5
```

---

## Flow

```text
Transaksi
↓
Detail Transaksi
↓
Menu
↓
Komposisi Menu
↓
Bahan Baku
↓
Update Stok
```

---

# 11. PROCUREMENT ARCHITECTURE

## Catering Procurement

```text
Pesanan Catering
↓
Status Terkonfirmasi
↓
Generate Kebutuhan Bahan
↓
Generate PDF
↓
Pembelian Supplier
```

---

## Operational Procurement

```text
Monitoring Stok
↓
Stok Minimum
↓
Generate Daftar Pembelian
↓
Generate PDF
```

---

## Receiving Goods

```text
Barang Diterima
↓
Input Penerimaan
↓
Update Stok
```

---

# 12. DEPLOYMENT ARCHITECTURE

## Development Environment

```text
MacOS / Windows

XAMPP

Laravel 11

MySQL
```

---

## Production Environment

```text
Client Browser
       │
       ▼
Apache Web Server
       │
       ▼
Laravel Application
       │
       ▼
MySQL Database
```

---

# 13. PROJECT STRUCTURE

```text
app/

├── Http
│   ├── Controllers
│   ├── Middleware
│   └── Requests

├── Models

├── Repositories

├── Services

resources/

├── views
│   ├── auth
│   ├── dashboard
│   ├── menu
│   ├── catering
│   ├── nasibox
│   ├── transaksi
│   ├── pengadaan
│   └── laporan

database/

├── migrations
├── seeders
└── factories

routes/

├── web.php
```

---

# 14. ARCHITECTURE PRINCIPLES

## Separation of Concerns

Setiap layer memiliki tanggung jawab yang berbeda.

---

## Reusability

Business logic dapat digunakan kembali melalui Service Layer.

---

## Maintainability

Kode mudah dipelihara dan dikembangkan.

---

## Scalability

Mudah ditambahkan fitur baru di masa mendatang.

---

## Security

Menggunakan:

* Laravel Breeze
* Authentication Middleware
* Role Middleware
* CSRF Protection
* Password Hashing
