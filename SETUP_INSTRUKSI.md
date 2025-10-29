# ✅ INSTRUKSI SETUP DATABASE WMS GUDANG

## 🎯 Langkah-Langkah Setup:

### **1. Pastikan XAMPP Running**

- Buka **XAMPP Control Panel**
- Klik **Start** pada **Apache** dan **MySQL**
- Pastikan keduanya berwarna HIJAU

### **2. Buka phpMyAdmin**

Buka browser dan akses: **`http://localhost/phpmyadmin`**

### **3. Import Database**

1. Klik pada tab **SQL** di phpMyAdmin
2. Klik tombol **"Choose File"** atau langsung paste script
3. Copy isi file **`database_import.sql`** dari folder project
4. Paste ke text area SQL di phpMyAdmin
5. Klik tombol **"Go"** di bagian bawah
6. Tunggu sampai muncul pesan: **"Import has been successfully finished"**

**Atau dengan cara lebih cepat:**

1. Di phpMyAdmin, klik tab **Import**
2. Klik **"Choose File"**
3. Pilih file **`database_import.sql`** dari folder: `C:\xampp\htdocs\prototipe-v1\`
4. Klik **"Go"**

### **4. Verifikasi Database**

1. Di phpMyAdmin, klik tab **Databases**
2. Cari database **`db_wms_gudang`**
3. Klik untuk melihat isinya
4. Pastikan ada 4 tabel:
   - ✅ `users` (ada 1 user: admin123)
   - ✅ `barang` (ada 11 barang)
   - ✅ `penerimaan` (kosong)
   - ✅ `pengeluaran` (kosong)

### **5. Edit File .env (PENTING!)**

File `.env` sudah saya buatkan di folder project. Jika perlu edit:

1. Buka file **`.env`** (ada di folder: `C:\xampp\htdocs\prototipe-v1\.env`)
2. Pastikan konfigurasi seperti ini:

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

**Catatan:**

- Jika password MySQL Anda BUKAN kosong, isi pada `database.default.password`
- Sesuaikan `app.baseURL` jika project Anda di subfolder berbeda

### **6. Test Aplikasi**

1. Buka browser
2. Akses: **`http://localhost/prototipe-v1/`**
3. Akan muncul halaman **Login**

### **7. Login ke Sistem**

- **Username:** `admin123`
- **Password:** `123456789`

---

## ✅ Checklist Setup:

- [ ] Apache dan MySQL sudah running (hijau)
- [ ] Database **`db_wms_gudang`** sudah dibuat di phpMyAdmin
- [ ] File **`database_import.sql`** sudah di-import
- [ ] 4 tabel sudah ada (users, barang, penerimaan, pengeluaran)
- [ ] Data 11 barang sudah ada
- [ ] User admin123 sudah ada
- [ ] File **`.env`** sudah dikonfigurasi dengan benar
- [ ] Bisa akses: `http://localhost/prototipe-v1/`
- [ ] Bisa login dengan admin123 / 123456789
- [ ] Masuk ke Dashboard

---

## 🔧 Troubleshooting:

### **Error: Access denied for user 'root'@'localhost'**

**Solusi:**

```env
database.default.password = passwordAnda
```

Edit file `.env` dan isi password MySQL Anda.

### **Error: Unknown database 'db_wms_gudang'**

**Solusi:**

- Import ulang file `database_import.sql`
- Atau buat database manual: `CREATE DATABASE db_wms_gudang;`

### **Error: 404 Not Found**

**Solusi:**

- Edit file `.env` pada baris `app.baseURL`
- Sesuaikan dengan URL project Anda
- Contoh: `http://localhost/prototipe-v1/`

### **Login gagal**

**Solusi:**

- Pastikan user admin123 sudah ada di tabel users
- Username: `admin123`
- Password: `123456789`

---

## 📊 Apa yang Ada di Database:

### **Tabel users:**

- 1 user default (admin123)

### **Tabel barang:**

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

### **Tabel penerimaan:**

- Kosong (siap untuk input data)

### **Tabel pengeluaran:**

- Kosong (siap untuk input data)

---

## 🎉 Selesai!

Setup database selesai! Anda bisa:

1. Login dengan admin123 / 123456789
2. Lihat Dashboard dan statistik
3. Cek Aset Gudang (11 barang, stok 0)
4. Terima Barang untuk menambah stok
5. Barang Keluar untuk mengurangi stok

**Selamat menggunakan WMS Gudang!**
