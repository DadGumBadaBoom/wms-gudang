# 🏭 WMS Gudang - Warehouse Management System

[![CodeIgniter Version](https://img.shields.io/badge/CodeIgniter-4.0+-red.svg)](https://codeigniter.com)
[![PHP Version](https://img.shields.io/badge/PHP-8.1+-blue.svg)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)

Sistem manajemen gudang berbasis web untuk mengelola stok barang masuk dan keluar secara real-time. Dibangun dengan **CodeIgniter 4** dan **MySQL**.

---

## 📋 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Teknologi](#-teknologi)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Instalasi](#-instalasi)
- [Penggunaan](#-penggunaan)
- [Struktur Project](#-struktur-project)
- [Database](#-database)
- [Troubleshooting](#-troubleshooting)
- [Lisensi](#-lisensi)

---

## ✨ Fitur Utama

### 🔐 Autentikasi

- Login dengan username dan password
- Session management
- Logout

### 📊 Dashboard

- Statistik total barang
- Jumlah penerimaan dan pengeluaran
- Monitoring barang dengan stok minimal
- Visualisasi data real-time

### 🏷️ Aset Gudang

- Daftar master barang lengkap
- Monitoring stok real-time
- Indikator peringatan stok minimal (< 10)

### 📦 Manajemen Penerimaan

- Input barang masuk dari supplier
- Update stok otomatis
- Riwayat penerimaan barang
- Tracking nomor SJ dan PO

### 🚚 Manajemen Pengeluaran

- Input barang keluar ke WIP
- Validasi stok tidak boleh negatif
- Modal pop-up untuk input barang
- Riwayat pengeluaran barang

---

## 🛠️ Teknologi

- **Framework:** CodeIgniter 4
- **Database:** MySQL (XAMPP)
- **Frontend:** Bootstrap 5, Font Awesome
- **PHP Version:** 8.1+
- **Server:** Apache (XAMPP)
- **Security:** Password hashing dengan bcrypt

---

## 💻 Persyaratan Sistem

- **PHP:** 8.1 atau lebih tinggi
- **MySQL:** 5.7+ atau MariaDB 10.3+
- **Apache:** 2.4+ (atau web server lain)
- **Composer:** Untuk dependency management
- **XAMPP:** (Opsional, untuk development lokal)

### Ekstensi PHP yang Diperlukan:

- `intl`
- `mbstring`
- `json`
- `mysqlnd` (untuk MySQL)
- `libcurl` (opsional)

---

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/prototipe-v1.git
cd prototipe-v1
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

Copy file `env` menjadi `.env`:

```bash
cp env .env
```

Edit file `.env` dan sesuaikan konfigurasi:

```env
CI_ENVIRONMENT = development

app.baseURL = 'http://localhost/prototipe-v1/'

database.default.hostname = localhost
database.default.database = db_wms_gudang
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306
```

### 4. Setup Database

#### Opsi A: Import via phpMyAdmin (Recommended)

1. Buka **phpMyAdmin**: `http://localhost/phpmyadmin`
2. Klik tab **"Import"**
3. Pilih file `database_import.sql` dari folder project
4. Klik **"Go"**

#### Opsi B: Via Command Line

```bash
cd C:\xampp\htdocs\prototipe-v1
php spark migrate
php spark db:seed BarangSeeder
php spark db:seed UserSeeder
```

### 5. Set Permissions

Pastikan folder `writable` memiliki izin tulis:

```bash
chmod -R 755 writable/
```

### 6. Start Server

Jika menggunakan XAMPP:

- Buka **XAMPP Control Panel**
- Start **Apache** dan **MySQL**

Untuk development server CodeIgniter:

```bash
php spark serve
```

### 7. Akses Aplikasi

Buka browser dan akses:

```
http://localhost/prototipe-v1/
```

**Login Default:**

- Username: `admin123`
- Password: `123456789`

---

## 📖 Penggunaan

### Login

Akses aplikasi melalui browser dan login dengan kredensial default.

### Dashboard

Setelah login, Anda akan melihat:

- Statistik total barang
- Jumlah penerimaan dan pengeluaran
- Barang dengan stok minimal
- Menu navigasi sidebar

### Aset Gudang

- Lihat daftar semua master barang
- Monitor stok real-time
- Barang dengan stok < 10 akan ditandai dengan badge warning

### Terima Barang

1. Pilih menu **"Terima Barang"**
2. Isi form:
   - Supplier
   - Tanggal
   - Kode Penerimaan
   - Nomor SJ dan PO (opsional)
   - Kode Barang
   - Jumlah
3. Klik **"Simpan Penerimaan"**
4. Stok otomatis bertambah

### Barang Keluar

1. Pilih menu **"Barang Keluar"**
2. Isi form:
   - Nomor Bon
   - Tujuan WIP
   - Tanggal Bon
3. Klik **"Tambah Barang Keluar"**
4. Pilih barang di modal pop-up
5. Input jumlah
6. Klik **"Kirim Barang ke WIP"**
7. Stok otomatis berkurang (dengan validasi tidak boleh negatif)

---

## 📁 Struktur Project

```
prototipe-v1/
├── app/
│   ├── Controllers/          # Controller aplikasi
│   │   ├── Auth.php
│   │   ├── Dashboard.php
│   │   ├── BarangController.php
│   │   ├── PenerimaanController.php
│   │   └── PengeluaranController.php
│   ├── Models/                # Model database
│   │   ├── UserModel.php
│   │   ├── BarangModel.php
│   │   ├── PenerimaanModel.php
│   │   └── PengeluaranModel.php
│   ├── Views/                 # Template view
│   │   ├── layout/           # Layout utama
│   │   ├── auth/             # View autentikasi
│   │   ├── dashboard/        # View dashboard
│   │   ├── barang/           # View master barang
│   │   ├── penerimaan/       # View penerimaan
│   │   └── pengeluaran/      # View pengeluaran
│   ├── Database/
│   │   ├── Migrations/       # Database migrations
│   │   └── Seeds/           # Database seeders
│   └── Filters/             # Filter untuk autentikasi
├── public/                   # Folder public (web root)
├── vendor/                   # Composer dependencies
├── writable/                 # Folder untuk log, cache, session
├── .env                     # File konfigurasi environment
├── database_import.sql      # File import database
└── README.md                # Dokumentasi ini
```

---

## 🗄️ Database

### Struktur Tabel

#### Tabel: `users`

- `id_user` (PK, Auto Increment)
- `username` (Unique)
- `password` (Bcrypt Hash)

#### Tabel: `barang`

- `id_barang` (PK, Auto Increment)
- `kode_barang` (Unique Key)
- `nama_barang`
- `stok_akhir`

#### Tabel: `penerimaan`

- `id_penerimaan` (PK, Auto Increment)
- `supplier`
- `tanggal`
- `kode_penerimaan`
- `nomor_sj` (Optional)
- `nomor_po` (Optional)
- `kode_barang` (FK)
- `jumlah`

#### Tabel: `pengeluaran`

- `id_pengeluaran` (PK, Auto Increment)
- `nomor_bon`
- `tujuan_wip`
- `tanggal_bon`
- `kode_barang` (FK)
- `jumlah_keluar`

### Data Master Barang

Aplikasi dilengkapi dengan 11 master barang default:

- AA001: Karton Laptop Asus 14 Inch
- AA002: Karton Laptop Asus 15 Inch
- AA003: Karton Laptop Asus 16 Inch
- AA004: Plastik Internal All Asus Series
- AA005: Karton Laptop MSI Katana Series
- AA006: Karton Laptop Bravo Series
- AA007: Karton Laptop Intelegance Series
- AA008: Karton Laptop Titan New
- AA009: Plastik Internal Black MSI Series
- AA010: Plastik Internal Transparant MSI All
- AA011: Plackband Karton Brown

---

## 🔧 Troubleshooting

### Error 404 Not Found

**Penyebab:** Konfigurasi baseURL tidak sesuai.

**Solusi:**

1. Edit file `.env`
2. Sesuaikan `app.baseURL` dengan URL project Anda
3. Pastikan Apache/webserver sudah running

### Error: Database tidak ditemukan

**Penyebab:** Database belum dibuat atau nama database salah.

**Solusi:**

1. Import file `database_import.sql` di phpMyAdmin
2. Atau buat database manual: `CREATE DATABASE db_wms_gudang;`
3. Pastikan konfigurasi di `.env` sesuai

### Error: Access denied for user 'root'@'localhost'

**Penyebab:** Password MySQL tidak kosong.

**Solusi:**
Edit file `.env`:

```env
database.default.password = passwordAnda
```

### Halaman Kosong / Blank

**Solusi:**

1. Cek error log di `writable/logs/`
2. Pastikan PHP version >= 8.1
3. Pastikan file `.env` ada di folder project
4. Pastikan ekstensi PHP yang diperlukan sudah terinstall

### Login Gagal

**Solusi:**

1. Pastikan user dengan password hash sudah ada di database
2. Password default: `123456789`
3. Jalankan seeder: `php spark db:seed UserSeeder`

### Stok Tidak Update

**Solusi:**

1. Cek relasi `kode_barang` di tabel penerimaan/pengeluaran
2. Pastikan kode barang sudah ada di master barang
3. Cek error log untuk detail error

---

## 📄 Dokumentasi Tambahan

- [`CARA_JALANKAN.md`](CARA_JALANKAN.md) - Panduan lengkap menjalankan aplikasi
- [`SETUP_DATABASE.md`](SETUP_DATABASE.md) - Panduan setup database detail
- [`SETUP_INSTRUKSI.md`](SETUP_INSTRUKSI.md) - Instruksi setup lengkap
- [`TEST_DATABASE.md`](TEST_DATABASE.md) - Panduan verifikasi database
- [`README_WMS.md`](README_WMS.md) - Dokumentasi sistem lengkap

---

## 🤝 Kontribusi

Kontribusi sangat diterima! Untuk perubahan besar:

1. Fork repository
2. Buat feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit perubahan (`git commit -m 'Add some AmazingFeature'`)
4. Push ke branch (`git push origin feature/AmazingFeature`)
5. Buat Pull Request

---

## 📝 License

Project ini menggunakan lisensi **MIT License**. Lihat file [LICENSE](LICENSE) untuk detail lebih lanjut.

---

## 👤 Author

Dibuat dengan ❤️ untuk manajemen gudang yang lebih baik.

---

**Selamat menggunakan WMS Gudang! 🎉**

Jika ada pertanyaan atau masalah, silakan buat [Issue](../../issues) di repository ini.
