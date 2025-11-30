# 📚 Sistem Informasi Manajemen Perpustakaan Digital (DigiLib)

![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)
![MySQL](https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql)

Sistem manajemen perpustakaan modern berbasis web yang dibangun menggunakan **Laravel 12** dan **Laravel Breeze**. Aplikasi ini dirancang untuk memfasilitasi sirkulasi buku (peminjaman & pengembalian), manajemen denda otomatis, serta katalog buku digital dengan sistem ulasan (review).

---

## 👨‍💻 Identitas Pengembang

Project ini disusun untuk memenuhi tugas mata kuliah Pemrograman Web.

| Info | Detail |
| :--- | :--- |
| **Nama** | **JONAS BA'KA** |
| **NIM** | **H071241031** |
| **Instagram** | [@_jonasbaka](https://instagram.com/_jonasbaka) |
| **WhatsApp** | [0822-9296-7902](https://wa.me/6282292967902) |

---

## 🚀 Fitur Utama

Sistem ini memiliki 3 level pengguna (*Multi-Role*) dengan hak akses berbeda:

### 1. Administrator (Admin)
* **Dashboard Analitik:** Melihat total buku, user, peminjaman aktif, buku terpopuler, dan user terrajin.
* **Manajemen User:** Menambah, mengedit, dan menghapus akun Staff dan Mahasiswa.
* **Manajemen Buku:** CRUD Buku lengkap dengan upload cover gambar.
* **Laporan:** Melihat total pendapatan denda dan statistik perpustakaan.

### 2. Pegawai (Staff)
* **Sirkulasi:** Memproses pengembalian buku dari mahasiswa.
* **Sistem Denda Otomatis:** Menghitung denda secara otomatis jika pengembalian melewati tanggal jatuh tempo.
* **Manajemen Denda:** Memproses pembayaran/pelunasan denda agar mahasiswa bisa meminjam kembali.

### 3. Mahasiswa (Student)
* **Katalog Buku:** Mencari buku berdasarkan judul, penulis, atau kategori.
* **Peminjaman:** Mengajukan peminjaman buku (validasi stok & cek denda).
* **Perpanjangan (Renew):** Memperpanjang masa pinjam jika belum terlambat.
* **Riwayat:** Melihat status buku (Dipinjam/Kembali/Terlambat).
* **Ulasan & Rating:** Memberikan ulasan pada buku yang sudah selesai dibaca.

---

## 🛠️ Teknologi yang Digunakan

* **Backend:** Laravel 12 (PHP 8.2+)
* **Frontend:** Blade Templates, Tailwind CSS, Alpine.js
* **Database:** MySQL
* **Auth:** Laravel Breeze (Multi-auth)
* **Storage:** Symbolic Link (untuk cover buku)

---

## ⚙️ Cara Instalasi

Ikuti langkah-langkah berikut untuk menjalankan project di komputer lokal Anda:

### 1. Clone Repository
```bash
git clone [https://github.com/username-anda/nama-repo.git](https://github.com/username-anda/nama-repo.git)
cd nama-repo