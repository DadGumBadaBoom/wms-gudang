# 🚀 Panduan Memulai Program Pertama Kali - WMS Gudang

## 📋 Daftar Isi

1. [Persyaratan Sistem](#persyaratan-sistem)
2. [Langkah-langkah Setup](#langkah-langkah-setup)
3. [Konfigurasi Database](#konfigurasi-database)
4. [Konfigurasi Aplikasi](#konfigurasi-aplikasi)
5. [Menjalankan Aplikasi](#menjalankan-aplikasi)
6. [Login Pertama Kali](#login-pertama-kali)
7. [Setup User Management](#setup-user-management)
8. [Troubleshooting](#troubleshooting)

---

## 💻 Persyaratan Sistem

### Software yang Diperlukan:

1. **XAMPP** (versi terbaru)

   - Apache
   - MySQL
   - PHP 8.0 atau lebih tinggi

2. **Web Browser**

   - Chrome, Firefox, Edge, atau browser modern lainnya

3. **Text Editor** (opsional)
   - VS Code, Notepad++, atau editor lainnya

---

## 📦 Langkah-langkah Setup

### **1. Install XAMPP**

1. Download XAMPP dari: https://www.apachefriends.org/
2. Install XAMPP di komputer Anda
3. Pastikan instalasi berhasil

### **2. Copy Project ke htdocs**

1. Copy folder `prototipe-v1` ke:

   ```
   C:\xampp\htdocs\prototipe-v1
   ```

2. Atau jika sudah ada, pastikan folder berada di:
   ```
   C:\xampp\htdocs\prototipe-v1
   ```

### **3. Start XAMPP Services**

1. Buka **XAMPP Control Panel**
2. Klik **Start** pada **Apache** (harus berubah menjadi hijau)
3. Klik **Start** pada **MySQL** (harus berubah menjadi hijau)

**Catatan:** Jika port 80 atau 3306 sudah digunakan, ubah port di XAMPP atau hentikan aplikasi yang menggunakan port tersebut.

---

## 🗄️ Konfigurasi Database

### **1. Buat Database**

**Cara 1: Via phpMyAdmin (Disarankan)**

1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Klik tab **"SQL"**
3. Copy dan paste script berikut:
   ```sql
   CREATE DATABASE IF NOT EXISTS `db_wms_gudang` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
   ```
4. Klik **"Go"**

**Cara 2: Import File SQL**

1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Klik tab **"Import"**
3. Klik **"Choose File"**
4. Pilih file: `C:\xampp\htdocs\prototipe-v1\database_import.sql`
5. Klik **"Go"**

### **2. Import Data**

1. Di phpMyAdmin, pilih database `db_wms_gudang`
2. Klik tab **"Import"**
3. Pilih file: `database_import.sql`
4. Klik **"Go"**

**Atau via SQL:**

1. Klik tab **"SQL"**
2. Buka file `database_import.sql` dengan text editor
3. Copy semua isinya
4. Paste di phpMyAdmin SQL tab
5. Klik **"Go"**

---

## ⚙️ Konfigurasi Aplikasi

### **1. Setup File .env**

1. Buka folder project: `C:\xampp\htdocs\prototipe-v1`
2. Cari file `.env` (jika tidak ada, copy dari file `env`)
3. Edit file `.env` dengan text editor
4. Pastikan konfigurasi berikut:

```env
#--------------------------------------------------------------------
# APP
#--------------------------------------------------------------------
app.baseURL = 'http://localhost/prototipe-v1/'

#--------------------------------------------------------------------
# DATABASE
#--------------------------------------------------------------------
database.default.hostname = localhost
database.default.database = db_wms_gudang
database.default.username = root
database.default.password =
database.default.DBDriver = MySQLi
database.default.port = 3306

#--------------------------------------------------------------------
# SESSION
#--------------------------------------------------------------------
# session.driver = 'CodeIgniter\Session\Handlers\FileHandler'
# session.savePath = null

#--------------------------------------------------------------------
# USER ADMIN SECRET KEY
#--------------------------------------------------------------------
user.admin.secret = "admin123456"
```

**Catatan:**

- Jika MySQL password tidak kosong, isi di `database.default.password`
- Jika menggunakan port selain 80, sesuaikan `app.baseURL`
- **PENTING:** Ganti `user.admin.secret` dengan key yang lebih aman!

### **2. Pastikan Folder Writable**

Pastikan folder berikut bisa ditulis (write permission):

- `writable/session/`
- `writable/cache/`
- `writable/logs/`

**Windows:** Biasanya sudah bisa ditulis secara default.

**Linux/Mac:**

```bash
chmod -R 777 writable/
```

---

## 🎯 Menjalankan Aplikasi

### **1. Pastikan XAMPP Running**

- ✅ Apache harus **hijau** (running)
- ✅ MySQL harus **hijau** (running)

### **2. Buka Browser**

1. Buka browser (Chrome, Firefox, Edge, dll)
2. Ketik URL berikut di address bar:

   ```
   http://localhost/prototipe-v1/
   ```

   **Atau jika menggunakan port lain:**

   ```
   http://localhost:8080/prototipe-v1/
   ```

### **3. Halaman Login Akan Muncul**

Jika berhasil, Anda akan melihat halaman login dengan:

- Background gradient purple
- Form username dan password
- Tombol login

---

## 🔐 Login Pertama Kali

### **Kredensial Default:**

- **Username:** `admin123`
- **Password:** `123456789`

### **Langkah Login:**

1. Masukkan username: `admin123`
2. Masukkan password: `123456789`
3. Klik tombol **"Login"**

### **Setelah Login Berhasil:**

Anda akan diarahkan ke **Dashboard** yang menampilkan:

- Total Barang
- Total Penerimaan
- Total Pengeluaran
- Stok Minimal

---

## 👥 Setup User Management

### **1. Akses Halaman Admin User Management**

**URL:**

```
http://localhost/prototipe-v1/user/admin?key=admin123456
```

**Default Secret Key:** `admin123456`

**Catatan:**

- Ganti secret key di file `.env` untuk keamanan lebih baik
- Secret key ini digunakan untuk akses halaman user management

### **2. Fitur yang Tersedia:**

- ✅ **Tambah User Baru** - Buat akun user baru
- ✅ **Edit User** - Ubah username dan password user
- ✅ **Hapus User** - Hapus user dari sistem

### **3. Ganti Password Default**

**Disarankan:** Segera ganti password default setelah login pertama kali!

**Cara:**

1. Akses: `http://localhost/prototipe-v1/user/admin?key=admin123456`
2. Klik tombol **Edit** pada user `admin123`
3. Isi password baru
4. Klik **Update User**

---

## 🔒 Keamanan Pertama Kali

### **1. Ganti Secret Key Admin**

1. Edit file `.env`
2. Ubah baris:
   ```env
   user.admin.secret = "ubah_dengan_key_rahasia_anda"
   ```
3. Simpan file
4. Restart Apache di XAMPP

### **2. Ganti Password Default**

- Ganti password user `admin123` segera setelah setup
- Gunakan password yang kuat (minimal 8 karakter, kombinasi huruf, angka, simbol)

### **3. Backup Database**

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Pilih database `db_wms_gudang`
3. Klik tab **"Export"**
4. Pilih **"Quick"** atau **"Custom"**
5. Klik **"Go"**
6. Simpan file backup

---

## ⚠️ Troubleshooting

### **Error: 404 Not Found**

**Penyebab:** URL tidak benar atau Apache tidak running

**Solusi:**

1. Pastikan Apache sudah running (hijau)
2. Cek URL: `http://localhost/prototipe-v1/`
3. Pastikan folder ada di `C:\xampp\htdocs\prototipe-v1`
4. Cek file `.env`, pastikan `app.baseURL` benar

### **Error: Database tidak ditemukan**

**Penyebab:** Database belum dibuat atau nama salah

**Solusi:**

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Import file `database_import.sql`
3. Atau buat database manual: `CREATE DATABASE db_wms_gudang;`
4. Cek file `.env`, pastikan nama database benar

### **Error: Access denied for user**

**Penyebab:** Username/password database salah

**Solusi:**

1. Edit file `.env`
2. Pastikan:
   ```env
   database.default.username = root
   database.default.password =
   ```
3. Jika MySQL punya password, isi di `database.default.password`

### **Error: Session tidak bisa dibuat**

**Penyebab:** Folder `writable/session` tidak bisa ditulis

**Solusi:**

1. Pastikan folder `writable/session` ada
2. Pastikan folder bisa ditulis (permission)
3. Windows: Biasanya sudah bisa ditulis
4. Linux/Mac: `chmod -R 777 writable/`

### **Error: CSRF token mismatch**

**Penyebab:** Form tidak memiliki CSRF token

**Solusi:**

1. Pastikan semua form memiliki `<?= csrf_field() ?>`
2. Jika menggunakan AJAX, tambahkan CSRF token di request
3. Refresh halaman dan coba lagi

### **Halaman Kosong / Blank**

**Penyebab:** Error PHP atau konfigurasi salah

**Solusi:**

1. Cek error log: `writable/logs/`
2. Pastikan PHP version >= 8.0
3. Pastikan file `.env` ada
4. Cek apakah semua file ada di folder project

---

## 📝 Checklist Setup Pertama Kali

Gunakan checklist ini untuk memastikan semua sudah benar:

- [ ] XAMPP sudah terinstall
- [ ] Apache sudah running (hijau)
- [ ] MySQL sudah running (hijau)
- [ ] Folder project ada di `C:\xampp\htdocs\prototipe-v1`
- [ ] Database `db_wms_gudang` sudah dibuat
- [ ] File `database_import.sql` sudah di-import
- [ ] File `.env` sudah ada dan dikonfigurasi
- [ ] Folder `writable/` bisa ditulis
- [ ] Aplikasi bisa diakses di browser
- [ ] Login dengan kredensial default berhasil
- [ ] Dashboard muncul dengan benar
- [ ] Secret key admin sudah diganti (disarankan)
- [ ] Password default sudah diganti (disarankan)

---

## 🎉 Setelah Setup Berhasil

### **Akses Aplikasi:**

- **Login:** `http://localhost/prototipe-v1/`
- **Dashboard:** `http://localhost/prototipe-v1/dashboard`
- **Admin User:** `http://localhost/prototipe-v1/user/admin?key=admin123456`

### **Fitur yang Tersedia:**

1. **Dashboard** - Lihat statistik gudang
2. **Aset Gudang** - Kelola master barang
3. **Terima Barang** - Input barang masuk
4. **Barang Keluar** - Input barang keluar
5. **User Management** - Kelola user (dengan secret key)

---

## 📚 Dokumentasi Tambahan

- `CARA_JALANKAN.md` - Panduan cepat menjalankan aplikasi
- `CARA_TAMBAH_USER.md` - Panduan user management
- `SETUP_INSTRUKSI.md` - Instruksi setup detail
- `README.md` - Dokumentasi umum aplikasi

---

## ⚡ Quick Start (Ringkas)

Jika Anda sudah familiar dengan XAMPP dan CodeIgniter:

1. ✅ Start Apache & MySQL di XAMPP
2. ✅ Import `database_import.sql` di phpMyAdmin
3. ✅ Edit `.env` (baseURL dan database)
4. ✅ Akses: `http://localhost/prototipe-v1/`
5. ✅ Login: `admin123` / `123456789`

**Selesai!** 🎉

---

**Selamat menggunakan WMS Gudang!** 🚀

Jika ada masalah, lihat bagian **Troubleshooting** di atas atau cek file log di `writable/logs/`.
