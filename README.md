# 🏭 WMS Gudang - Warehouse Management System

Sistem Manajemen Gudang berbasis web untuk mengelola aset, penerimaan, dan pengeluaran barang di gudang.

## 📋 Deskripsi

WMS Gudang adalah aplikasi web untuk manajemen gudang yang dibangun dengan **CodeIgniter 4**. Aplikasi ini menyediakan fitur lengkap untuk mengelola:

- 📦 **Master Barang** - Kelola data barang di gudang
- 📥 **Penerimaan Barang** - Input barang masuk dari supplier
- 📤 **Pengeluaran Barang** - Input barang keluar ke WIP (Work In Progress)
- 📊 **Dashboard** - Statistik dan informasi gudang
- 👥 **User Management** - Kelola user dengan sistem keamanan

## ✨ Fitur Utama

- ✅ **Dashboard** - Statistik real-time (Total Barang, Penerimaan, Pengeluaran, Stok Minimal)
- ✅ **Manajemen Aset Gudang** - Kelola master data barang
- ✅ **Penerimaan Barang** - Input barang masuk dengan detail supplier, PO, SJ
- ✅ **Barang Keluar** - Input barang keluar ke WIP dengan sistem bon produksi
- ✅ **User Management** - CRUD user dengan sistem keamanan secret key
- ✅ **Keamanan** - CSRF Protection, XSS Protection, Rate Limiting, Password Hashing
- ✅ **UI Modern** - Desain responsif dengan Bootstrap 5 dan gradient yang menarik

## 🛠️ Teknologi yang Digunakan

- **Framework:** CodeIgniter 4
- **PHP:** 8.0+
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Font Awesome
- **Server:** Apache (XAMPP)

## 📦 Persyaratan Sistem

- PHP 8.0 atau lebih tinggi
- MySQL 5.7+ atau MariaDB
- Apache Web Server
- Composer (untuk dependencies)

## 🚀 Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/wms-gudang.git
cd wms-gudang
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Database

1. Buat database di MySQL:
   ```sql
   CREATE DATABASE db_wms_gudang CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```

2. Import database:
   - Buka phpMyAdmin: `http://localhost/phpmyadmin`
   - Import file `database_import.sql`

### 4. Konfigurasi Environment

1. Copy file `env` menjadi `.env`
2. Edit file `.env` dan sesuaikan konfigurasi:

```env
app.baseURL = 'http://localhost/prototipe-v1/'

database.default.hostname = localhost
database.default.database = db_wms_gudang
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi

user.admin.secret = "ubah_dengan_key_rahasia_anda"
```

### 5. Set Permission (Linux/Mac)

```bash
chmod -R 777 writable/
```

### 6. Jalankan Aplikasi

1. Start Apache dan MySQL di XAMPP
2. Akses: `http://localhost/prototipe-v1/`

## 🔐 Login Default

- **Username:** `admin123`
- **Password:** `123456789`

**⚠️ PENTING:** Ganti password default setelah login pertama kali!

## 📖 Dokumentasi

- **[PANDUAN_PERTAMA_KALI.md](PANDUAN_PERTAMA_KALI.md)** - Panduan lengkap setup pertama kali
- **[CARA_TAMBAH_USER.md](CARA_TAMBAH_USER.md)** - Panduan user management

## 🔒 Keamanan

Aplikasi ini sudah dilengkapi dengan:

- ✅ **CSRF Protection** - Proteksi terhadap Cross-Site Request Forgery
- ✅ **XSS Protection** - Output escaping untuk mencegah XSS attack
- ✅ **SQL Injection Protection** - Menggunakan Query Builder (prepared statements)
- ✅ **Rate Limiting** - Proteksi brute force (5 percobaan per 5 menit)
- ✅ **Password Hashing** - Menggunakan bcrypt
- ✅ **Session Security** - Validasi user setiap request
- ✅ **Secret Key System** - Untuk akses admin panel

## 📁 Struktur Project

```
prototipe-v1/
├── app/
│   ├── Controllers/      # Controller aplikasi
│   ├── Models/           # Model database
│   ├── Views/            # Template view
│   ├── Filters/          # Filter keamanan
│   └── Config/           # Konfigurasi
├── public/               # Web root
├── writable/             # Folder writable (session, cache, logs)
├── database_import.sql   # File import database
├── .env                  # Konfigurasi environment
└── README.md             # Dokumentasi ini
```

## 🎯 Fitur Detail

### Dashboard
- Statistik total barang
- Total penerimaan
- Total pengeluaran
- Barang dengan stok minimal
- Informasi sistem

### Aset Gudang
- Lihat semua master barang
- Cari barang berdasarkan kode
- Lihat stok tersedia

### Penerimaan Barang
- Input barang masuk
- Detail supplier, tanggal, kode penerimaan
- Nomor PO dan SJ (opsional)
- Update stok otomatis

### Barang Keluar
- Input barang keluar ke WIP
- Sistem bon produksi
- Multiple barang dalam satu bon
- Update stok otomatis

### User Management
- Tambah user baru
- Edit user (username & password)
- Hapus user
- Ganti password
- **Akses dengan secret key** (tidak muncul di menu)

## 🔧 Konfigurasi

### Secret Key Admin

Secret key untuk akses user management dapat diubah di file `.env`:

```env
user.admin.secret = "key_rahasia_anda"
```

**Default:** `admin123456`

**⚠️ PENTING:** Ganti secret key default untuk keamanan!

### Base URL

Sesuaikan base URL di file `.env`:

```env
app.baseURL = 'http://localhost/prototipe-v1/'
```

## 🐛 Troubleshooting

### Error 404 Not Found
- Pastikan Apache sudah running
- Cek konfigurasi `app.baseURL` di `.env`
- Pastikan folder ada di `htdocs`

### Error Database
- Pastikan MySQL sudah running
- Cek konfigurasi database di `.env`
- Pastikan database sudah dibuat dan di-import

### Error Session
- Pastikan folder `writable/session` bisa ditulis
- Cek permission folder `writable/`

Lihat **[PANDUAN_PERTAMA_KALI.md](PANDUAN_PERTAMA_KALI.md)** untuk troubleshooting lengkap.

## 📝 Lisensi

Lihat file [LICENSE](LICENSE) untuk detail lisensi.

## 👤 Author

Dibuat untuk kebutuhan manajemen gudang.

## 🙏 Acknowledgments

- CodeIgniter 4 Framework
- Bootstrap 5
- Font Awesome

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**⭐ Jika project ini membantu, jangan lupa berikan star! ⭐**

