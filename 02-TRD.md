# 02-TRD.md

# TECHNICAL REQUIREMENT DOCUMENT

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. TECHNICAL OVERVIEW

## Deskripsi Sistem

Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web merupakan aplikasi yang digunakan untuk mengelola seluruh proses operasional Warung BBC mulai dari transaksi dine-in, pemesanan catering, pemesanan nasi box, pembayaran, pengelolaan persediaan bahan baku, pengadaan bahan baku, dashboard monitoring, hingga pembuatan laporan.

Sistem dibangun menggunakan Framework Laravel dengan pola arsitektur MVC (Model View Controller) serta menerapkan Service Layer dan Repository Pattern untuk memisahkan logika bisnis dan akses data.

---

# 2. TECHNOLOGY STACK

## Backend

| Komponen           | Teknologi  |
| ------------------ | ---------- |
| Framework          | Laravel 11 |
| Bahasa Pemrograman | PHP 8.2+   |

---

## Frontend

| Komponen        | Teknologi          |
| --------------- | ------------------ |
| Template Engine | Blade              |
| CSS Framework   | Bootstrap 5        |
| Javascript      | Vanilla Javascript |

---

## Database

| Komponen | Teknologi |
| -------- | --------- |
| Database | MySQL 8   |

---

## Reporting

| Komponen   | Teknologi |
| ---------- | --------- |
| PDF Export | DomPDF    |

---

## Dashboard

| Komponen | Teknologi |
| -------- | --------- |
| Grafik   | ChartJS   |

---

## Authentication

| Komponen       | Teknologi      |
| -------------- | -------------- |
| Authentication | Laravel Breeze |

---

## Version Control

| Komponen   | Teknologi |
| ---------- | --------- |
| Repository | GitHub    |

---

# 3. SYSTEM ARCHITECTURE

## High Level Architecture

```text
User
 │
 ▼
Web Browser
 │
 ▼
Laravel Application
 │
 ├── Authentication Module
 ├── Master Data Module
 ├── POS Module
 ├── Catering Module
 ├── Nasi Box Module
 ├── Inventory Module
 ├── Procurement Module
 ├── Dashboard Module
 └── Reporting Module
 │
 ▼
MySQL Database
```

---

# 4. LAYER ARCHITECTURE

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

## Presentation Layer

Berfungsi menampilkan antarmuka pengguna.

Komponen:

* Blade View
* Bootstrap 5
* Javascript
* ChartJS

---

## Controller Layer

Berfungsi menerima request dari pengguna dan meneruskan proses ke service layer.

Controller:

* AuthController
* DashboardController
* MenuController
* SupplierController
* PelangganController
* BahanBakuController
* CateringController
* NasiBoxController
* TransaksiController
* PembayaranController
* PengadaanController
* ReportController

---

## Service Layer

Berfungsi menangani logika bisnis.

Service:

* AuthenticationService
* InventoryService
* CateringService
* NasiBoxService
* ProcurementService
* PaymentService
* DashboardService
* ReportingService

---

## Repository Layer

Berfungsi menangani akses data ke database.

Repository:

* UserRepository
* MenuRepository
* SupplierRepository
* PelangganRepository
* InventoryRepository
* CateringRepository
* ProcurementRepository

---

# 5. USER ACCESS MATRIX

| Modul       | Kasir | Tim Dapur | Manager | Pemilik |
| ----------- | ----- | --------- | ------- | ------- |
| Login       | ✓     | ✓         | ✓       | ✓       |
| Master Data | -     | -         | -       | ✓       |
| POS         | ✓     | View      | -       | ✓       |
| Catering    | -     | View      | -       | ✓       |
| Nasi Box    | -     | View      | -       | ✓       |
| Inventory   | -     | View      | ✓       | ✓       |
| Procurement | -     | -         | -       | ✓       |
| Dashboard   | -     | -         | ✓       | ✓       |
| Reporting   | -     | -         | ✓       | ✓       |

---

# 6. MODULE SPECIFICATION

## Authentication Module

### Fungsi

Mengelola autentikasi pengguna.

### Fitur

* Login
* Logout
* Session Management

### Input

* Username
* Password

### Output

* Dashboard berdasarkan role

---

## Master Data Module

### Menu

Input:

* Nama Menu
* Harga
* Kategori

Output:

* Daftar Menu

---

### Paket Catering

Input:

* Nama Paket
* Harga Paket

Output:

* Daftar Paket Catering

---

### Paket Nasi Box

Input:

* Nama Paket
* Harga Paket

Output:

* Daftar Paket Nasi Box

---

### Bahan Baku

Input:

* Nama Bahan
* Satuan
* Stok Minimum

Output:

* Daftar Bahan Baku

---

### Supplier

Input:

* Nama Supplier
* Telepon
* Alamat

Output:

* Daftar Supplier

---

### Pelanggan

Input:

* Nama Pelanggan
* Telepon
* Alamat

Output:

* Daftar Pelanggan

---

### Komposisi Menu

Input:

* Menu
* Bahan Baku
* Jumlah Penggunaan

Output:

* Detail Komposisi Menu

---

# 7. POS MODULE

## Tujuan

Mengelola transaksi dine-in.

### Input

* Nomor Meja
* Menu
* Jumlah Pesanan

### Proses

1. Kasir membuat transaksi.
2. Sistem menghitung total transaksi.
3. Sistem mengurangi stok bahan baku otomatis.
4. Sistem menyimpan transaksi.

### Output

* Detail transaksi
* Status transaksi
* Struk pembayaran

---

# 8. CATERING MODULE

## Tujuan

Mengelola pemesanan catering.

### Input

* Pelanggan
* Paket Catering
* Jumlah Porsi
* Tanggal Acara
* Lokasi Acara

### Proses

1. Pemilik membuat pesanan.
2. Sistem menyimpan data.
3. Sistem menghasilkan nomor pesanan.

### Output

* Data pesanan catering
* Status pesanan

---

# 9. NASI BOX MODULE

## Tujuan

Mengelola pemesanan nasi box.

### Input

* Pelanggan
* Paket Nasi Box
* Jumlah Box
* Tanggal Pengiriman

### Proses

1. Pemilik membuat pesanan.
2. Sistem menyimpan data pesanan.

### Output

* Data pesanan nasi box
* Status pesanan

---

# 10. INVENTORY MODULE

## Tujuan

Mengelola persediaan bahan baku.

### Fitur

* Monitoring stok
* Monitoring stok minimum
* Riwayat stok
* Pengurangan stok otomatis

### Output

* Informasi stok terkini

---

# 11. PROCUREMENT MODULE

## Catering Procurement

### Input

Pesanan catering yang telah terkonfirmasi.

### Proses

1. Sistem membaca detail paket catering.
2. Sistem menghitung kebutuhan bahan baku.
3. Sistem menghasilkan daftar pembelian.
4. Sistem membuat file PDF.

### Output

* Daftar kebutuhan bahan baku
* PDF pembelian

---

## Operational Procurement

### Input

Data stok minimum.

### Proses

1. Sistem mendeteksi stok minimum.
2. Sistem menghasilkan daftar pembelian.
3. Sistem membuat PDF.

### Output

* Daftar pembelian operasional

---

## Receiving Goods

### Input

Data penerimaan barang.

### Proses

1. Pemilik menginput barang diterima.
2. Sistem menambah stok bahan baku.

### Output

* Stok terbaru

---

# 12. DASHBOARD MODULE

Dashboard menampilkan:

* Total Penjualan Hari Ini
* Total Transaksi Hari Ini
* Total Catering Aktif
* Total Nasi Box Aktif
* Produk Terlaris
* Stok Menipis

---

# 13. REPORTING MODULE

## Laporan Penjualan

* Harian
* Bulanan
* Tahunan

## Laporan Catering

* Periode tertentu

## Laporan Nasi Box

* Periode tertentu

## Laporan Persediaan

* Data stok

## Laporan Pengadaan

* Data pengadaan

Output:

* PDF
* Print

---

# 14. BUSINESS RULES

### BR-01

Seluruh pengguna wajib login.

### BR-02

Hak akses ditentukan berdasarkan role.

### BR-03

Kasir hanya dapat mengelola transaksi dine-in.

### BR-04

Pemilik mengelola catering dan nasi box.

### BR-05

Pengurangan stok dilakukan otomatis berdasarkan komposisi menu.

### BR-06

Stok tidak boleh bernilai negatif.

### BR-07

Pesanan catering harus berstatus terkonfirmasi sebelum pengadaan.

### BR-08

Penerimaan barang menambah stok otomatis.

### BR-09

Nomor transaksi harus unik.

### BR-10

Nomor pengadaan harus unik.

---

# 15. SECURITY REQUIREMENTS

* Password menggunakan hashing bcrypt.
* Session timeout otomatis.
* Role Based Access Control.
* CSRF Protection.
* Form Validation.

---

# 16. PERFORMANCE REQUIREMENTS

* Waktu respon maksimal 3 detik.
* Mendukung minimal 20 pengguna aktif.
* Query database terindeks.

---

# 17. ERROR HANDLING

* Validasi input.
* Penanganan data kosong.
* Penanganan stok tidak mencukupi.
* Penanganan transaksi gagal.

---

# 18. DEPLOYMENT REQUIREMENTS

Server:

* Apache
* PHP 8.2+
* MySQL 8

Environment:

* Production
* Staging
* Development

Backup:

* Backup database harian.
* Backup source code melalui GitHub.
