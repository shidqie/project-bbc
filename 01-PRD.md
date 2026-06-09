# 01-PRD.md

# PRODUCT REQUIREMENT DOCUMENT

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. PROJECT OVERVIEW

## Latar Belakang

Warung BBC merupakan usaha kuliner yang menyediakan layanan makan di tempat (dine-in), pemesanan catering, dan pemesanan nasi box. Proses bisnis yang berjalan saat ini masih dilakukan secara manual, mulai dari pencatatan transaksi, pengelolaan pesanan catering, pengelolaan stok bahan baku, hingga pembuatan laporan.

Kondisi tersebut menimbulkan berbagai kendala seperti keterlambatan pencatatan transaksi, kesulitan memantau persediaan bahan baku secara real-time, keterlambatan pengadaan bahan baku, serta proses pembuatan laporan yang memerlukan waktu cukup lama.

Untuk mengatasi permasalahan tersebut diperlukan sebuah Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web yang mampu mengintegrasikan seluruh proses bisnis ke dalam satu sistem.

---

## Deskripsi Sistem

Sistem digunakan untuk mengelola:

* Transaksi Dine-In
* Pemesanan Catering
* Pemesanan Nasi Box
* Pembayaran
* Persediaan Bahan Baku
* Pengadaan Bahan Baku
* Dashboard Monitoring
* Laporan Operasional

Sistem menerapkan konsep Bill of Material (BOM) dimana setiap menu memiliki komposisi bahan baku yang digunakan sebagai dasar pengurangan stok secara otomatis.

---

# 2. BUSINESS GOALS

### BG-01

Meningkatkan efisiensi operasional usaha.

### BG-02

Mengurangi kesalahan pencatatan transaksi.

### BG-03

Mengurangi kesalahan pencatatan stok bahan baku.

### BG-04

Mempermudah pengelolaan pesanan catering dan nasi box.

### BG-05

Mempermudah proses pengadaan bahan baku.

### BG-06

Mempercepat pembuatan laporan.

---

# 3. SYSTEM GOALS

### SG-01

Mengintegrasikan seluruh proses bisnis ke dalam satu sistem.

### SG-02

Menyediakan informasi stok bahan baku secara real-time.

### SG-03

Mengotomatisasi pengurangan stok berdasarkan transaksi.

### SG-04

Menghasilkan laporan secara otomatis.

### SG-05

Menyediakan dashboard monitoring operasional.

---

# 4. PROJECT SCOPE

## In Scope

### POS Dine-In

* Input transaksi
* Detail transaksi
* Pembayaran
* Cetak struk

### Catering

* Input pesanan catering
* Konfirmasi pesanan
* Monitoring status

### Nasi Box

* Input pesanan nasi box
* Monitoring status

### Inventory

* Monitoring stok bahan baku
* Monitoring stok minimum
* Pengurangan stok otomatis

### Procurement

* Pengadaan bahan baku catering
* Pengadaan bahan baku operasional
* Penerimaan barang

### Dashboard

* Monitoring operasional

### Reporting

* Penjualan
* Catering
* Nasi Box
* Persediaan
* Pengadaan

---

## Out of Scope

* Mobile Application
* Payment Gateway
* WhatsApp API
* Multi Cabang
* Integrasi Marketplace

---

# 5. USER ROLES

## Kasir

Tugas:

* Mengelola transaksi dine-in
* Mengelola pembayaran
* Mencetak struk

Hak Akses:

* Login
* Dashboard Kasir
* POS
* Pembayaran

---

## Tim Dapur

Tugas:

* Menyiapkan pesanan
* Memantau persediaan

Hak Akses:

* Login
* Daftar Pesanan
* Detail Pesanan
* Persediaan

---

## Manager

Tugas:

* Monitoring operasional

Hak Akses:

* Dashboard
* Laporan
* Persediaan

---

## Pemilik

Tugas:

* Mengelola seluruh operasional

Hak Akses:

* Seluruh fitur sistem

---

# 6. USER FLOW

## Dine-In

Pelanggan Datang
→ Kasir Input Pesanan
→ Sistem Mengurangi Stok Otomatis
→ Tim Dapur Melihat Pesanan
→ Pesanan Disiapkan
→ Pembayaran
→ Cetak Struk

---

## Catering

Konsumen Memesan
→ Pemilik Input Pesanan
→ Konfirmasi Pesanan
→ Generate Kebutuhan Bahan Baku
→ Pengadaan Bahan Baku
→ Produksi
→ Pengiriman
→ Selesai

---

## Nasi Box

Konsumen Memesan
→ Pemilik Input Pesanan
→ Produksi
→ Pengiriman
→ Selesai

---

## Pengadaan Catering

Pemilik Melihat Catering Terkonfirmasi
→ Generate Kebutuhan Bahan Baku
→ Generate Daftar Pembelian
→ Export PDF
→ Pembelian ke Supplier
→ Barang Diterima
→ Input Penerimaan Barang
→ Stok Bertambah Otomatis

---

## Pengadaan Operasional

Sistem Menampilkan Stok Minimum
→ Generate Daftar Pembelian
→ Export PDF
→ Pembelian ke Supplier
→ Barang Diterima
→ Input Penerimaan Barang
→ Stok Bertambah Otomatis

---

# 7. FEATURE LIST

## Authentication

* Login
* Logout
* Role Management

## Master Data

* Menu
* Paket Catering
* Paket Nasi Box
* Bahan Baku
* Supplier
* Pelanggan
* Meja
* Komposisi Menu

## POS

* Transaksi Dine-In
* Pembayaran
* Cetak Struk

## Catering

* Input Pesanan
* Konfirmasi
* Monitoring Status

## Nasi Box

* Input Pesanan
* Monitoring Status

## Inventory

* Monitoring Stok
* Monitoring Stok Minimum
* Auto Stock Reduction

## Procurement

* Generate Purchase List
* Export PDF
* Receiving Goods

## Dashboard

* Total Penjualan
* Total Transaksi
* Produk Terlaris
* Catering Aktif
* Nasi Box Aktif
* Stok Menipis

## Reporting

* Laporan Penjualan
* Laporan Catering
* Laporan Nasi Box
* Laporan Persediaan
* Laporan Pengadaan

---

# 8. FUNCTIONAL REQUIREMENTS

FR-01 Sistem harus menyediakan autentikasi berdasarkan role.

FR-02 Sistem harus mengelola data menu.

FR-03 Sistem harus mengelola paket catering.

FR-04 Sistem harus mengelola paket nasi box.

FR-05 Sistem harus mengelola bahan baku.

FR-06 Sistem harus mengelola supplier.

FR-07 Sistem harus mengelola pelanggan.

FR-08 Sistem harus mencatat transaksi dine-in.

FR-09 Sistem harus memproses pembayaran.

FR-10 Sistem harus mencatat pesanan catering.

FR-11 Sistem harus mencatat pesanan nasi box.

FR-12 Sistem harus mengurangi stok otomatis berdasarkan komposisi menu.

FR-13 Sistem harus menghasilkan kebutuhan bahan baku catering.

FR-14 Sistem harus menghasilkan daftar pembelian operasional.

FR-15 Sistem harus memperbarui stok setelah penerimaan barang.

FR-16 Sistem harus menghasilkan dashboard monitoring.

FR-17 Sistem harus menghasilkan laporan.

---

# 9. NON FUNCTIONAL REQUIREMENTS

## Performance

* Response time maksimal 3 detik.
* Mendukung minimal 20 pengguna aktif.

## Security

* Password Hashing
* Role Based Access Control
* Session Management

## Reliability

* Data transaksi tersimpan konsisten.
* Pengurangan stok berjalan akurat.

## Usability

* Mudah digunakan.
* Responsive pada desktop dan laptop.

---

# 10. SUCCESS METRICS

* Seluruh transaksi tercatat secara digital.
* Akurasi stok minimal 95%.
* Pengurangan kesalahan pencatatan minimal 80%.
* Waktu pembuatan laporan kurang dari 5 detik.
* Informasi stok tersedia secara real-time.

---

# 11. FUTURE ENHANCEMENT

* Mobile Application
* WhatsApp Notification
* Payment Gateway
* Multi Branch Support
* Business Intelligence Dashboard
