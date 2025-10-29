# 🚀 Cara Menjalankan Aplikasi WMS Gudang

## ⚡ Langkah Cepat:

### **1. Pastikan XAMPP Running**

Buka **XAMPP Control Panel**:

- Klik **Start** pada **Apache** (harus hijau)
- Klik **Start** pada **MySQL** (harus hijau)

### **2. Import Database** (Jika Belum)

**A. Buka phpMyAdmin:**

```
http://localhost/phpmyadmin
```

**B. Import Database:**

1. Klik tab **"Import"**
2. Klik **"Choose File"**
3. Pilih file: `C:\xampp\htdocs\prototipe-v1\database_import.sql`
4. Klik **"Go"**

**Atau via SQL:**

1. Klik tab **"SQL"**
2. Copy isi file `database_import.sql`
3. Paste dan klik **"Go"**

### **3. Buka Aplikasi di Browser**

**URL:**

```
http://localhost/prototipe-v1/
```

**Login:**

- **Username:** `admin123`
- **Password:** `123456789`

---

## 📋 Checklist Sebelum Jalankan:

- [ ] Apache sudah running (hijau di XAMPP)
- [ ] MySQL sudah running (hijau di XAMPP)
- [ ] Database `db_wms_gudang` sudah dibuat
- [ ] File `.env` sudah ada di folder project
- [ ] Aplikasi bisa diakses di browser

---

## 🔍 Test Aplikasi:

### **1. Test Halaman Login**

Akses: `http://localhost/prototipe-v1/`

- Harus muncul halaman login dengan desain gradient purple
- Ada form username dan password

### **2. Test Login**

Input:

- Username: `admin123`
- Password: `123456789`
- Klik Login

**Harus muncul:**

- Halaman Dashboard
- Sidebar di kiri
- Statistik cards (Total Barang, Penerimaan, Pengeluaran)

### **3. Test Fitur**

- ✅ Dashboard → Lihat statistik
- ✅ Aset Gudang → Lihat 11 barang (stok 0)
- ✅ Terima Barang → Form input tersedia
- ✅ Barang Keluar → Form dan modal tersedia

---

## ⚠️ Troubleshooting:

### **Error 404 Not Found**

```
http://localhost/prototipe-v1/ → 404
```

**Solusi:**

1. Cek Apache sudah running
2. Cek URL benar: `http://localhost/prototipe-v1/`
3. Edit file `.env`: `app.baseURL = 'http://localhost/prototipe-v1/'`

### **Error: Database tidak ditemukan**

```
Error: Unknown database 'db_wms_gudang'
```

**Solusi:**

1. Import file `database_import.sql` di phpMyAdmin
2. Atau buat manual: `CREATE DATABASE db_wms_gudang;`

### **Error: Access denied for user**

```
Error: Access denied for user 'root'@'localhost'
```

**Solusi:**
Edit file `.env`:

```env
database.default.password = passwordAnda
```

### **Halaman Kosong / Blank**

**Solusi:**

1. Cek error log: `writable/logs/`
2. Pastikan PHP version >= 8.0
3. Pastikan file `.env` ada di folder project

---

## ✅ Setelah Berhasil Login:

1. **Dashboard** akan muncul dengan:

   - Total Barang: 11
   - Total Penerimaan: 0
   - Total Pengeluaran: 0
   - Barang Stok Minimal: 0

2. **Sidebar** di kiri:

   - Dashboard
   - Aset Gudang
   - Terima Barang
   - Barang Keluar
   - Logout

3. **Coba Fitur:**
   - Aset Gudang → Lihat semua barang
   - Terima Barang → Coba input (AA001, jumlah: 50)
   - Aset Gudang lagi → Stok jadi 50
   - Barang Keluar → Kirim 20 ke WIP
   - Aset Gudang lagi → Stok jadi 30

---

**Selamat! Aplikasi WMS Gudang siap digunakan! 🎉**
