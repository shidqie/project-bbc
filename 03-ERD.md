# 03-ERD.md

# ENTITY RELATIONSHIP DIAGRAM (ERD)

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. ENTITY LIST

Sistem terdiri dari 18 entitas yang dikelompokkan menjadi:

## Master Data

1. users
2. pelanggan
3. menu
4. paket_catering
5. detail_paket_catering
6. paket_nasibox
7. detail_paket_nasibox
8. bahan_baku
9. komposisi_menu
10. supplier
11. meja

---

## Transaction

12. pesanan_catering
13. pesanan_nasibox
14. transaksi_dinein
15. detail_transaksi
16. pembayaran

---

## Procurement

17. pengadaan
18. detail_pengadaan

---

# 2. ENTITY DEFINITION

## users

### Primary Key

* id

### Attributes

| Field      | Type         |
| ---------- | ------------ |
| id         | bigint       |
| nama_user  | varchar(100) |
| username   | varchar(50)  |
| password   | varchar(255) |
| role       | enum         |
| created_at | timestamp    |
| updated_at | timestamp    |

---

## pelanggan

### Primary Key

* id

### Attributes

| Field          | Type         |
| -------------- | ------------ |
| id             | bigint       |
| nama_pelanggan | varchar(100) |
| telepon        | varchar(20)  |
| alamat         | text         |

---

## menu

### Primary Key

* id

### Attributes

| Field     | Type         |
| --------- | ------------ |
| id        | bigint       |
| nama_menu | varchar(100) |
| kategori  | varchar(50)  |
| harga     | decimal      |

---

## paket_catering

### Primary Key

* id

### Attributes

| Field       | Type         |
| ----------- | ------------ |
| id          | bigint       |
| nama_paket  | varchar(100) |
| harga_paket | decimal      |

---

## detail_paket_catering

### Primary Key

* id

### Foreign Key

* paket_catering_id
* menu_id

### Attributes

| Field | Type    |
| ----- | ------- |
| qty   | integer |

---

## paket_nasibox

### Primary Key

* id

### Attributes

| Field       | Type         |
| ----------- | ------------ |
| id          | bigint       |
| nama_paket  | varchar(100) |
| harga_paket | decimal      |

---

## detail_paket_nasibox

### Primary Key

* id

### Foreign Key

* paket_nasibox_id
* menu_id

### Attributes

| Field | Type    |
| ----- | ------- |
| qty   | integer |

---

## bahan_baku

### Primary Key

* id

### Attributes

| Field        | Type         |
| ------------ | ------------ |
| id           | bigint       |
| nama_bahan   | varchar(100) |
| satuan       | varchar(30)  |
| stok         | decimal      |
| stok_minimum | decimal      |

---

## komposisi_menu

### Primary Key

* id

### Foreign Key

* menu_id
* bahan_baku_id

### Attributes

| Field             | Type    |
| ----------------- | ------- |
| jumlah_penggunaan | decimal |

---

## supplier

### Primary Key

* id

### Attributes

| Field         | Type         |
| ------------- | ------------ |
| id            | bigint       |
| nama_supplier | varchar(100) |
| telepon       | varchar(20)  |
| alamat        | text         |

---

## meja

### Primary Key

* id

### Attributes

| Field      | Type        |
| ---------- | ----------- |
| id         | bigint      |
| nomor_meja | varchar(10) |
| status     | enum        |

---

## pesanan_catering

### Primary Key

* id

### Foreign Key

* pelanggan_id
* paket_catering_id

### Attributes

| Field         | Type    |
| ------------- | ------- |
| tanggal_acara | date    |
| lokasi_acara  | text    |
| jumlah_porsi  | integer |
| status        | enum    |

---

## pesanan_nasibox

### Primary Key

* id

### Foreign Key

* pelanggan_id
* paket_nasibox_id

### Attributes

| Field              | Type    |
| ------------------ | ------- |
| tanggal_pengiriman | date    |
| jumlah_box         | integer |
| status             | enum    |

---

## transaksi_dinein

### Primary Key

* id

### Foreign Key

* user_id
* meja_id

### Attributes

| Field             | Type     |
| ----------------- | -------- |
| tanggal_transaksi | datetime |
| total             | decimal  |
| status            | enum     |

---

## detail_transaksi

### Primary Key

* id

### Foreign Key

* transaksi_id
* menu_id

### Attributes

| Field    | Type    |
| -------- | ------- |
| qty      | integer |
| harga    | decimal |
| subtotal | decimal |

---

## pembayaran

### Primary Key

* id

### Foreign Key

* transaksi_id

### Attributes

| Field         | Type     |
| ------------- | -------- |
| metode_bayar  | enum     |
| total_bayar   | decimal  |
| tanggal_bayar | datetime |

---

## pengadaan

### Primary Key

* id

### Foreign Key

* supplier_id

### Attributes

| Field             | Type |
| ----------------- | ---- |
| tanggal_pengadaan | date |
| jenis_pengadaan   | enum |
| status            | enum |

---

## detail_pengadaan

### Primary Key

* id

### Foreign Key

* pengadaan_id
* bahan_baku_id

### Attributes

| Field    | Type    |
| -------- | ------- |
| qty      | decimal |
| harga    | decimal |
| subtotal | decimal |

---

# 3. RELATIONSHIP DEFINITION

## Pelanggan dan Pesanan Catering

```text
Pelanggan (1)
      │
      └──────< Pesanan_Catering (N)
```

Cardinality:

1 : N

---

## Pelanggan dan Pesanan Nasi Box

```text
Pelanggan (1)
      │
      └──────< Pesanan_NasiBox (N)
```

Cardinality:

1 : N

---

## Paket Catering dan Detail Paket Catering

```text
Paket_Catering (1)
       │
       └──────< Detail_Paket_Catering (N)
```

Cardinality:

1 : N

---

## Menu dan Detail Paket Catering

```text
Menu (1)
    │
    └──────< Detail_Paket_Catering (N)
```

Cardinality:

1 : N

---

## Paket Nasi Box dan Detail Paket Nasi Box

```text
Paket_NasiBox (1)
       │
       └──────< Detail_Paket_NasiBox (N)
```

Cardinality:

1 : N

---

## Menu dan Detail Paket Nasi Box

```text
Menu (1)
    │
    └──────< Detail_Paket_NasiBox (N)
```

Cardinality:

1 : N

---

## Menu dan Komposisi Menu

```text
Menu (1)
    │
    └──────< Komposisi_Menu (N)
```

Cardinality:

1 : N

---

## Bahan Baku dan Komposisi Menu

```text
Bahan_Baku (1)
      │
      └──────< Komposisi_Menu (N)
```

Cardinality:

1 : N

---

## User dan Transaksi

```text
Users (1)
    │
    └──────< Transaksi_DineIn (N)
```

Cardinality:

1 : N

---

## Meja dan Transaksi

```text
Meja (1)
    │
    └──────< Transaksi_DineIn (N)
```

Cardinality:

1 : N

---

## Transaksi dan Detail Transaksi

```text
Transaksi_DineIn (1)
          │
          └──────< Detail_Transaksi (N)
```

Cardinality:

1 : N

---

## Menu dan Detail Transaksi

```text
Menu (1)
    │
    └──────< Detail_Transaksi (N)
```

Cardinality:

1 : N

---

## Transaksi dan Pembayaran

```text
Transaksi_DineIn (1)
          │
          └────── Pembayaran (1)
```

Cardinality:

1 : 1

---

## Supplier dan Pengadaan

```text
Supplier (1)
      │
      └──────< Pengadaan (N)
```

Cardinality:

1 : N

---

## Pengadaan dan Detail Pengadaan

```text
Pengadaan (1)
       │
       └──────< Detail_Pengadaan (N)
```

Cardinality:

1 : N

---

## Bahan Baku dan Detail Pengadaan

```text
Bahan_Baku (1)
      │
      └──────< Detail_Pengadaan (N)
```

Cardinality:

1 : N

---

# 4. RELATIONSHIP MATRIX

| Parent Entity    | Child Entity          | Relationship |
| ---------------- | --------------------- | ------------ |
| pelanggan        | pesanan_catering      | 1:N          |
| pelanggan        | pesanan_nasibox       | 1:N          |
| paket_catering   | detail_paket_catering | 1:N          |
| menu             | detail_paket_catering | 1:N          |
| paket_nasibox    | detail_paket_nasibox  | 1:N          |
| menu             | detail_paket_nasibox  | 1:N          |
| menu             | komposisi_menu        | 1:N          |
| bahan_baku       | komposisi_menu        | 1:N          |
| users            | transaksi_dinein      | 1:N          |
| meja             | transaksi_dinein      | 1:N          |
| transaksi_dinein | detail_transaksi      | 1:N          |
| menu             | detail_transaksi      | 1:N          |
| transaksi_dinein | pembayaran            | 1:1          |
| supplier         | pengadaan             | 1:N          |
| pengadaan        | detail_pengadaan      | 1:N          |
| bahan_baku       | detail_pengadaan      | 1:N          |

---

# 5. ERD SUMMARY

## Total Entitas

| Kategori    | Jumlah |
| ----------- | ------ |
| Master Data | 11     |
| Transaction | 5      |
| Procurement | 2      |
| Total       | 18     |

---

## Core Business Process Mapping

### POS

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
```

### Catering

```text
Pelanggan
↓
Pesanan Catering
↓
Paket Catering
↓
Detail Paket
↓
Menu
```

### Inventory

```text
Menu
↓
Komposisi Menu
↓
Bahan Baku
```

### Procurement

```text
Supplier
↓
Pengadaan
↓
Detail Pengadaan
↓
Bahan Baku
```
