# 08-Frontend-Website.md

# WEBSITE KONSUMEN

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. OVERVIEW

Website konsumen merupakan halaman yang dapat diakses oleh pelanggan tanpa harus login.

Tujuan website:

* Menampilkan informasi Warung BBC
* Menampilkan daftar menu
* Menampilkan paket catering
* Menampilkan paket nasi box
* Memfasilitasi pemesanan catering
* Memfasilitasi pemesanan nasi box
* Menampilkan status pesanan
* Menyediakan informasi kontak

---

# 2. WEBSITE SITEMAP

```text
Home
│
├── Tentang Kami
│
├── Menu
│
├── Catering
│   ├── Daftar Paket
│   └── Detail Paket
│
├── Nasi Box
│   ├── Daftar Paket
│   └── Detail Paket
│
├── Pemesanan Catering
│
├── Pemesanan Nasi Box
│
├── Tracking Pesanan
│
└── Kontak
```

---

# 3. HOME PAGE

## URL

```text
/
```

## Tujuan

Menjadi halaman utama website.

## Komponen

### Hero Section

Menampilkan:

* Logo Warung BBC
* Slogan
* Tombol Pesan Catering
* Tombol Pesan Nasi Box

---

### Tentang Singkat

Menampilkan:

* Profil singkat usaha
* Pengalaman usaha
* Keunggulan layanan

---

### Paket Catering Unggulan

Menampilkan:

* Nama Paket
* Harga
* Tombol Detail

---

### Paket Nasi Box Unggulan

Menampilkan:

* Nama Paket
* Harga
* Tombol Detail

---

### Testimoni

Menampilkan:

* Nama Pelanggan
* Isi Testimoni

---

### Footer

Menampilkan:

* Alamat
* Nomor Telepon
* Email
* Media Sosial

---

# 4. TENTANG KAMI

## URL

```text
/about
```

## Tujuan

Menampilkan profil usaha.

## Informasi

* Sejarah Warung BBC
* Visi
* Misi
* Foto Tempat
* Foto Produksi

---

# 5. MENU PAGE

## URL

```text
/menus
```

## Tujuan

Menampilkan seluruh menu yang tersedia.

## Informasi

### Data Menu

* Foto Menu
* Nama Menu
* Kategori
* Harga

## Filter

* Makanan
* Minuman
* Paket

---

# 6. CATERING PAGE

## URL

```text
/catering
```

## Tujuan

Menampilkan seluruh paket catering.

## Informasi

### Paket Catering

* Nama Paket
* Harga
* Jumlah Minimal Porsi
* Tombol Detail

---

# 7. DETAIL CATERING PAGE

## URL

```text
/catering/{id}
```

## Tujuan

Menampilkan detail paket catering.

## Informasi

### Detail Paket

* Nama Paket
* Daftar Menu
* Harga Paket
* Deskripsi Paket

## Tombol

* Pesan Sekarang

---

# 8. NASI BOX PAGE

## URL

```text
/nasi-box
```

## Tujuan

Menampilkan seluruh paket nasi box.

## Informasi

### Paket Nasi Box

* Nama Paket
* Harga
* Tombol Detail

---

# 9. DETAIL NASI BOX PAGE

## URL

```text
/nasi-box/{id}
```

## Tujuan

Menampilkan detail paket nasi box.

## Informasi

### Detail Paket

* Nama Paket
* Isi Paket
* Harga

## Tombol

* Pesan Sekarang

---

# 10. FORM PEMESANAN CATERING

## URL

```text
/order/catering
```

## Tujuan

Memungkinkan pelanggan melakukan pemesanan catering.

## Form Input

### Data Pelanggan

* Nama Pelanggan
* Nomor Telepon
* Alamat

### Data Acara

* Tanggal Acara
* Lokasi Acara

### Data Pesanan

* Paket Catering
* Jumlah Porsi
* Catatan

---

## Output

Data tersimpan ke:

```text
pesanan_catering
```

Status awal:

```text
menunggu_konfirmasi
```

---

# 11. FORM PEMESANAN NASI BOX

## URL

```text
/order/nasi-box
```

## Tujuan

Memungkinkan pelanggan melakukan pemesanan nasi box.

## Form Input

### Data Pelanggan

* Nama Pelanggan
* Nomor Telepon
* Alamat

### Data Pesanan

* Paket Nasi Box
* Jumlah Box
* Tanggal Pengiriman
* Catatan

---

## Output

Data tersimpan ke:

```text
pesanan_nasibox
```

Status awal:

```text
diproses
```

---

# 12. TRACKING PESANAN

## URL

```text
/tracking
```

## Tujuan

Memungkinkan pelanggan memantau status pesanan.

## Form Input

* Nomor Pesanan

## Output

### Catering

* Menunggu Konfirmasi
* Terkonfirmasi
* Diproduksi
* Dikirim
* Selesai

### Nasi Box

* Diproses
* Dikirim
* Selesai

---

# 13. KONTAK

## URL

```text
/contact
```

## Tujuan

Menampilkan informasi kontak usaha.

## Informasi

* Alamat
* Nomor Telepon
* Email
* Google Maps
* Jam Operasional

---

# 14. FRONTEND DESIGN STRUCTURE

## Navbar

* Home
* Tentang Kami
* Menu
* Catering
* Nasi Box
* Tracking
* Kontak

---

## Footer

* Alamat
* Telepon
* Email
* Sosial Media

---

# 15. RESPONSIVE REQUIREMENTS

Website harus responsif untuk:

* Desktop
* Laptop
* Tablet
* Smartphone

---

# 16. FRONTEND TECHNOLOGY

## Framework

```text
Laravel Blade
Bootstrap 5
```

## Library

```text
Bootstrap Icons
AOS Animation
SweetAlert2
```

---

# 17. BUSINESS RULES

BR-01 Pelanggan dapat melihat seluruh informasi tanpa login.

BR-02 Pemesanan catering dapat dilakukan langsung melalui website.

BR-03 Pemesanan nasi box dapat dilakukan langsung melalui website.

BR-04 Setiap pesanan otomatis masuk ke sistem admin.

BR-05 Status pesanan dapat dilihat melalui halaman tracking.

BR-06 Perubahan status pesanan dilakukan oleh Pemilik melalui sistem admin.
