# 04-Database-Schema.md

# DATABASE SCHEMA

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# DATABASE OVERVIEW

Database menggunakan:

* MySQL 8
* InnoDB Engine
* UTF8MB4 Character Set

Jumlah tabel:

```text
18 Tabel
```

---

# 1. USERS

## Tujuan

Menyimpan data pengguna sistem.

## Struktur Tabel

| Field      | Type         | Constraint |
| ---------- | ------------ | ---------- |
| id         | BIGINT       | PK, AI     |
| nama_user  | VARCHAR(100) | NOT NULL   |
| username   | VARCHAR(50)  | UNIQUE     |
| password   | VARCHAR(255) | NOT NULL   |
| role       | ENUM         | NOT NULL   |
| created_at | TIMESTAMP    |            |
| updated_at | TIMESTAMP    |            |

### Role

```text
pemilik
manager
kasir
tim_dapur
```

---

# 2. PELANGGAN

## Tujuan

Menyimpan data pelanggan.

| Field          | Type         | Constraint |
| -------------- | ------------ | ---------- |
| id             | BIGINT       | PK, AI     |
| nama_pelanggan | VARCHAR(100) | NOT NULL   |
| telepon        | VARCHAR(20)  |            |
| alamat         | TEXT         |            |
| created_at     | TIMESTAMP    |            |
| updated_at     | TIMESTAMP    |            |

---

# 3. MENU

## Tujuan

Menyimpan data menu makanan dan minuman.

| Field      | Type          | Constraint |
| ---------- | ------------- | ---------- |
| id         | BIGINT        | PK, AI     |
| nama_menu  | VARCHAR(100)  | NOT NULL   |
| kategori   | VARCHAR(50)   | NOT NULL   |
| harga      | DECIMAL(12,2) | NOT NULL   |
| created_at | TIMESTAMP     |            |
| updated_at | TIMESTAMP     |            |

---

# 4. PAKET_CATERING

## Tujuan

Menyimpan paket catering.

| Field       | Type          |
| ----------- | ------------- |
| id          | BIGINT PK     |
| nama_paket  | VARCHAR(100)  |
| harga_paket | DECIMAL(12,2) |
| created_at  | TIMESTAMP     |
| updated_at  | TIMESTAMP     |

---

# 5. DETAIL_PAKET_CATERING

## Tujuan

Menyimpan daftar menu dalam paket catering.

| Field             | Type      |
| ----------------- | --------- |
| id                | BIGINT PK |
| paket_catering_id | BIGINT FK |
| menu_id           | BIGINT FK |
| qty               | INT       |

### Foreign Key

```text
paket_catering_id → paket_catering.id
menu_id → menu.id
```

---

# 6. PAKET_NASIBOX

## Tujuan

Menyimpan paket nasi box.

| Field       | Type          |
| ----------- | ------------- |
| id          | BIGINT PK     |
| nama_paket  | VARCHAR(100)  |
| harga_paket | DECIMAL(12,2) |
| created_at  | TIMESTAMP     |
| updated_at  | TIMESTAMP     |

---

# 7. DETAIL_PAKET_NASIBOX

## Tujuan

Menyimpan daftar menu dalam paket nasi box.

| Field            | Type      |
| ---------------- | --------- |
| id               | BIGINT PK |
| paket_nasibox_id | BIGINT FK |
| menu_id          | BIGINT FK |
| qty              | INT       |

### Foreign Key

```text
paket_nasibox_id → paket_nasibox.id
menu_id → menu.id
```

---

# 8. BAHAN_BAKU

## Tujuan

Menyimpan stok bahan baku.

| Field        | Type          |
| ------------ | ------------- |
| id           | BIGINT PK     |
| nama_bahan   | VARCHAR(100)  |
| satuan       | VARCHAR(30)   |
| stok         | DECIMAL(12,2) |
| stok_minimum | DECIMAL(12,2) |
| created_at   | TIMESTAMP     |
| updated_at   | TIMESTAMP     |

---

# 9. KOMPOSISI_MENU

## Tujuan

Menyimpan Bill of Material (BOM).

| Field             | Type          |
| ----------------- | ------------- |
| id                | BIGINT PK     |
| menu_id           | BIGINT FK     |
| bahan_baku_id     | BIGINT FK     |
| jumlah_penggunaan | DECIMAL(12,2) |

### Foreign Key

```text
menu_id → menu.id
bahan_baku_id → bahan_baku.id
```

Contoh:

```text
Ayam Penyet

Ayam = 1
Beras = 0.2
Cabai = 0.05
```

---

# 10. SUPPLIER

## Tujuan

Menyimpan data supplier.

| Field         | Type         |
| ------------- | ------------ |
| id            | BIGINT PK    |
| nama_supplier | VARCHAR(100) |
| telepon       | VARCHAR(20)  |
| alamat        | TEXT         |
| created_at    | TIMESTAMP    |
| updated_at    | TIMESTAMP    |

---

# 11. MEJA

## Tujuan

Menyimpan data meja restoran.

| Field      | Type        |
| ---------- | ----------- |
| id         | BIGINT PK   |
| nomor_meja | VARCHAR(10) |
| status     | ENUM        |

### Status

```text
kosong
terisi
```

---

# 12. PESANAN_CATERING

## Tujuan

Menyimpan data pesanan catering.

| Field             | Type      |
| ----------------- | --------- |
| id                | BIGINT PK |
| pelanggan_id      | BIGINT FK |
| paket_catering_id | BIGINT FK |
| tanggal_acara     | DATE      |
| lokasi_acara      | TEXT      |
| jumlah_porsi      | INT       |
| status            | ENUM      |
| created_at        | TIMESTAMP |
| updated_at        | TIMESTAMP |

### Status

```text
menunggu_konfirmasi
terkonfirmasi
diproduksi
dikirim
selesai
dibatalkan
```

---

# 13. PESANAN_NASIBOX

## Tujuan

Menyimpan data pesanan nasi box.

| Field              | Type      |
| ------------------ | --------- |
| id                 | BIGINT PK |
| pelanggan_id       | BIGINT FK |
| paket_nasibox_id   | BIGINT FK |
| tanggal_pengiriman | DATE      |
| jumlah_box         | INT       |
| status             | ENUM      |
| created_at         | TIMESTAMP |
| updated_at         | TIMESTAMP |

### Status

```text
diproses
dikirim
selesai
dibatalkan
```

---

# 14. TRANSAKSI_DINEIN

## Tujuan

Menyimpan transaksi dine-in.

| Field             | Type          |
| ----------------- | ------------- |
| id                | BIGINT PK     |
| user_id           | BIGINT FK     |
| meja_id           | BIGINT FK     |
| tanggal_transaksi | DATETIME      |
| total             | DECIMAL(12,2) |
| status            | ENUM          |
| created_at        | TIMESTAMP     |
| updated_at        | TIMESTAMP     |

### Status

```text
diproses
selesai
```

---

# 15. DETAIL_TRANSAKSI

## Tujuan

Menyimpan detail item transaksi.

| Field        | Type          |
| ------------ | ------------- |
| id           | BIGINT PK     |
| transaksi_id | BIGINT FK     |
| menu_id      | BIGINT FK     |
| qty          | INT           |
| harga        | DECIMAL(12,2) |
| subtotal     | DECIMAL(12,2) |

---

# 16. PEMBAYARAN

## Tujuan

Menyimpan pembayaran transaksi.

| Field         | Type          |
| ------------- | ------------- |
| id            | BIGINT PK     |
| transaksi_id  | BIGINT FK     |
| metode_bayar  | ENUM          |
| total_bayar   | DECIMAL(12,2) |
| tanggal_bayar | DATETIME      |

### Metode Pembayaran

```text
tunai
transfer
qris
```

---

# 17. PENGADAAN

## Tujuan

Menyimpan data pengadaan bahan baku.

| Field             | Type      |
| ----------------- | --------- |
| id                | BIGINT PK |
| supplier_id       | BIGINT FK |
| tanggal_pengadaan | DATE      |
| jenis_pengadaan   | ENUM      |
| status            | ENUM      |
| created_at        | TIMESTAMP |
| updated_at        | TIMESTAMP |

### Jenis Pengadaan

```text
catering
operasional
```

### Status

```text
draft
dipesan
diterima
```

---

# 18. DETAIL_PENGADAAN

## Tujuan

Menyimpan detail bahan baku yang dibeli.

| Field         | Type          |
| ------------- | ------------- |
| id            | BIGINT PK     |
| pengadaan_id  | BIGINT FK     |
| bahan_baku_id | BIGINT FK     |
| qty           | DECIMAL(12,2) |
| harga         | DECIMAL(12,2) |
| subtotal      | DECIMAL(12,2) |

---

# INDEXING STRATEGY

## Unique Index

```text
users.username
meja.nomor_meja
```

---

## Foreign Key Index

```text
pelanggan_id
supplier_id
menu_id
bahan_baku_id
transaksi_id
pengadaan_id
```

---

# DATABASE BUSINESS RULES

## DBR-01

Setiap transaksi memiliki minimal satu detail transaksi.

## DBR-02

Setiap pembayaran harus terkait dengan transaksi.

## DBR-03

Stok bahan baku tidak boleh negatif.

## DBR-04

Pesanan catering harus terkonfirmasi sebelum pengadaan.

## DBR-05

Penerimaan barang akan menambah stok bahan baku.

## DBR-06

Penjualan menu akan mengurangi stok berdasarkan tabel komposisi_menu.

---

# INVENTORY FLOW

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

# PROCUREMENT FLOW

```text
Pesanan Catering
↓
Generate Kebutuhan Bahan
↓
Generate Daftar Pembelian
↓
Pengadaan
↓
Detail Pengadaan
↓
Penerimaan Barang
↓
Update Stok
```
