# 🏭 Sistem WMS Gudang (Warehouse Management System)

## 📋 Deskripsi

Sistem Warehouse Management System (WMS) berbasis CodeIgniter 4 untuk mengelola stok barang masuk dan keluar dalam satu gudang.

---

## ✨ Fitur Utama

### 🔐 Authentication

- Login dengan username dan password
- Session management
- Logout

### 📊 Dashboard

- Statistik total barang
- Jumlah penerimaan
- Jumlah pengeluaran
- Barang dengan stok minimal

### 🏷️ Aset Gudang

- Menampilkan semua master barang
- Menampilkan stok real-time
- Indikator stok minimal (warning jika < 10)

### 📦 Terima Barang

- Input barang masuk dari supplier
- Update stok otomatis
- Riwayat penerimaan

### 🚚 Barang Keluar (Bon Produksi)

- Input barang keluar ke WIP
- Validasi stok tidak boleh negatif
- Modal pop-up untuk input barang
- Riwayat pengeluaran

---

## 🛠️ Teknologi

- **Framework:** CodeIgniter 4
- **Database:** MySQL (XAMPP)
- **Frontend:** Bootstrap 5, Font Awesome
- **PHP Version:** 8.0+
- **Server:** Apache (XAMPP)

---

## 📦 Instalasi

### 1. Clone/Download Project

Project sudah ada di folder: `C:\xampp\htdocs\prototipe-v1`

### 2. Start XAMPP

- Buka **XAMPP Control Panel**
- Start **Apache** dan **MySQL**

### 3. Setup Database

Ikuti panduan di file **SETUP_DATABASE.md** untuk:

- Membuat database `db_wms_gudang`
- Import tabel dan data

### 4. Konfigurasi File .env

Edit file `.env` di folder project:

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

**Catatan:** Jika password MySQL Anda tidak kosong, isi pada `database.default.password`

### 5. Eksekusi Migration

Buka Command Prompt/PowerShell di folder project:

```bash
cd C:\xampp\htdocs\prototipe-v1
php spark migrate
php spark db:seed BarangSeeder
php spark db:seed UserSeeder
```

### 6. Akses Aplikasi

Buka browser: `http://localhost/prototipe-v1/`

### 7. Login

- **Username:** `admin123`
- **Password:** `123456789`

---

## 📁 Struktur Folder

```
prototipe-v1/
├── app/
│   ├── Controllers/
│   │   ├── Auth.php
│   │   ├── Dashboard.php
│   │   ├── BarangController.php
│   │   ├── PenerimaanController.php
│   │   └── PengeluaranController.php
│   ├── Models/
│   │   ├── UserModel.php
│   │   ├── BarangModel.php
│   │   ├── PenerimaanModel.php
│   │   └── PengeluaranModel.php
│   ├── Views/
│   │   ├── layout/
│   │   │   ├── main.php
│   │   │   ├── header.php
│   │   │   ├── sidebar.php
│   │   │   └── footer.php
│   │   ├── auth/
│   │   │   └── login.php
│   │   ├── dashboard/
│   │   │   └── index.php
│   │   ├── barang/
│   │   │   └── index.php
│   │   ├── penerimaan/
│   │   │   └── index.php
│   │   └── pengeluaran/
│   │       └── index.php
│   ├── Database/
│   │   ├── Migrations/
│   │   └── Seeds/
│   └── Filters/
│       └── AuthFilter.php
├── public/
├── .env
└── README_WMS.md
```

---

## 📝 Cara Menggunakan

### 1. Login

- Buka: `http://localhost/prototipe-v1/`
- Input username dan password
- Klik **Login**

### 2. Dashboard

- Lihat statistik gudang
- Total barang, penerimaan, pengeluaran

### 3. Aset Gudang

- Lihat daftar semua barang
- Cek stok real-time
- Stok minimal akan ditandai dengan badge warning

### 4. Terima Barang

- Pilih **Supplier**
- Input **Tanggal**, **Kode Penerimaan**
- Input **Nomor SJ** dan **Nomor PO** (opsional)
- Pilih **Kode Barang**
- Input **Jumlah**
- Klik **Simpan Penerimaan**
- Stok otomatis bertambah

### 5. Barang Keluar

- Input **Nomor Bon**
- Pilih **Tujuan WIP**
- Input **Tanggal Bon**
- Klik **Tambah Barang Keluar**
- Pilih barang di modal pop-up
- Input jumlah
- Klik **Kirim Barang ke WIP**
- Stok otomatis berkurang

---

## 🔧 Troubleshooting

### Error: 404 Not Found

**Solusi:**

- Pastikan `app.baseURL` di file `.env` sudah benar
- Sesuaikan dengan URL project Anda

### Error: Database tidak ditemukan

**Solusi:**

- Pastikan database `db_wms_gudang` sudah dibuat
- Cek konfigurasi di file `.env`
- Restart MySQL di XAMPP

### Error: Access denied for user

**Solusi:**

- Pastikan username: `root`
- Jika pakai password, update di `.env`
- Restart MySQL

### Tidak bisa login

**Solusi:**

- Pastikan user dengan password hash sudah ada di database
- Password default: `123456789` (hash: bcrypt)
- Jalankan: `php spark db:seed UserSeeder`

### Stok tidak update

**Solusi:**

- Cek relasi `kode_barang` di tabel penerimaan/pengeluaran
- Pastikan kode barang sudah ada di master

---

## 📊 Database

### Tabel: users

- `id_user` (PK)
- `username` (unique)
- `password` (bcrypt hash)

### Tabel: barang

- `id_barang` (PK)
- `kode_barang` (unique key)
- `nama_barang`
- `stok_akhir`

### Tabel: penerimaan

- `id_penerimaan` (PK)
- `supplier`
- `tanggal`
- `kode_penerimaan`
- `nomor_sj`
- `nomor_po`
- `kode_barang`
- `jumlah`

### Tabel: pengeluaran

- `id_pengeluaran` (PK)
- `nomor_bon`
- `tujuan_wip`
- `tanggal_bon`
- `kode_barang`
- `jumlah_keluar`

---

## 🎯 Data Master Barang

| Kode  | Nama Barang                          | Stok Awal |
| ----- | ------------------------------------ | --------- |
| AA001 | Karton Laptop Asus 14 Inch           | 0         |
| AA002 | Karton Laptop Asus 15 Inch           | 0         |
| AA003 | Karton Laptop Asus 16 Inch           | 0         |
| AA004 | Plastik Internal All Asus Series     | 0         |
| AA005 | Karton Laptop MSI Katana Series      | 0         |
| AA006 | Karton Laptop Bravo Series           | 0         |
| AA007 | Karton Laptop Intelegance Series     | 0         |
| AA008 | Karton Laptop Titan New              | 0         |
| AA009 | Plastik Internal Black MSI Series    | 0         |
| AA010 | Plastik Internal Transparant MSI All | 0         |
| AA011 | Plackband Karton Brown               | 0         |

---

## 👥 User Default

- **Username:** `admin123`
- **Password:** `123456789`
- **Role:** admin

---

## 📞 Support

Jika ada masalah atau pertanyaan:

1. Cek file **SETUP_DATABASE.md** untuk troubleshooting
2. Pastikan semua file migration sudah dijalankan
3. Pastikan konfigurasi `.env` sudah benar
4. Restart XAMPP jika perlu

---

## 📄 License

Project ini dibuat untuk keperluan pembelajaran dan development.

---

**Selamat menggunakan WMS Gudang! 🎉**
