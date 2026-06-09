# 06-AI-Agent.md

# AI AGENT DEFINITION

## Sistem Informasi Pemesanan Catering dan Point of Sale (POS) Berbasis Web

Versi: 1.0

---

# 1. AI AGENT OVERVIEW

Pengembangan sistem menggunakan pendekatan Multi Agent Development.

Tujuan:

* Memecah pekerjaan menjadi beberapa spesialis.
* Mengurangi kesalahan implementasi.
* Mempermudah pengembangan bertahap.
* Memastikan kode sesuai standar Laravel.

---

# 2. AGENT STRUCTURE

Project Manager Agent
│
├── System Architect Agent
├── Database Architect Agent
├── Backend Engineer Agent
├── Frontend Engineer Agent
├── Inventory Engineer Agent
├── Procurement Engineer Agent
├── QA Engineer Agent
└── Documentation Agent

---

# 3. PROJECT MANAGER AGENT

## Role

Mengelola seluruh proses pengembangan.

## Responsibility

* Membaca PRD
* Membaca TRD
* Membaca ERD
* Membuat roadmap
* Menentukan prioritas modul

## Output

* Development Plan
* Sprint Plan
* Task Breakdown

---

# 4. SYSTEM ARCHITECT AGENT

## Role

Mendesain arsitektur aplikasi.

## Responsibility

* MVC Architecture
* Service Layer
* Repository Pattern
* Folder Structure

## Output

* Architecture Design
* Coding Standard
* Project Structure

---

# 5. DATABASE ARCHITECT AGENT

## Role

Merancang database.

## Responsibility

* Migration
* Foreign Key
* Seeder
* Factory

## Input

* ERD
* Database Schema

## Output

* Migration Files
* Seeder Files
* Relationship Mapping

---

# 6. BACKEND ENGINEER AGENT

## Role

Mengembangkan backend Laravel.

## Responsibility

* Models
* Controllers
* Services
* Repositories
* Form Request Validation

## Output

* Business Logic
* CRUD Module
* API Logic

---

# 7. FRONTEND ENGINEER AGENT

## Role

Mengembangkan tampilan aplikasi.

## Responsibility

* Blade Template
* Bootstrap 5
* Dashboard
* CRUD View

## Output

* Responsive UI
* Dashboard Interface
* Reporting Interface

---

# 8. INVENTORY ENGINEER AGENT

## Role

Mengembangkan modul persediaan.

## Responsibility

* BOM Logic
* Auto Stock Reduction
* Stock Validation

## Business Rules

Menu
↓
Komposisi Menu
↓
Bahan Baku
↓
Update Stok

## Output

* InventoryService
* Stock Monitoring
* Stock Reduction Logic

---

# 9. PROCUREMENT ENGINEER AGENT

## Role

Mengembangkan modul pengadaan.

## Responsibility

* Catering Procurement
* Operational Procurement
* Receiving Goods

## Output

* ProcurementService
* Purchase List Generator
* Receiving Module

---

# 10. QA ENGINEER AGENT

## Role

Melakukan pengujian sistem.

## Responsibility

* Functional Testing
* Validation Testing
* Integration Testing

## Output

* Test Cases
* Bug Report
* Validation Report

---

# 11. DOCUMENTATION AGENT

## Role

Menyusun dokumentasi proyek.

## Responsibility

* README
* User Guide
* Technical Documentation

## Output

* Documentation Package

---

# 12. DEVELOPMENT ORDER

Urutan pengembangan wajib:

1. Project Manager Agent
2. System Architect Agent
3. Database Architect Agent
4. Backend Engineer Agent
5. Inventory Engineer Agent
6. Procurement Engineer Agent
7. Frontend Engineer Agent
8. QA Engineer Agent
9. Documentation Agent

---

# 13. AI CODING RULES

* Menggunakan Laravel 11.
* Menggunakan Laravel Breeze.
* Menggunakan Bootstrap 5.
* Menggunakan MySQL.
* Menggunakan Service Layer.
* Menggunakan Repository Pattern.
* Mengikuti prinsip SOLID.
* Tidak menulis business logic di controller.
* Menggunakan Form Request Validation.
* Menggunakan Migration dan Seeder.
