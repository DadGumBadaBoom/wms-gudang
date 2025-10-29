# ✅ TEST DATABASE - Cek Setup Database

## 🔍 Quick Check:

### **1. Cek Apache Running**

✅ Apache sudah running di port 80

### **2. Cek MySQL Running**

✅ MySQL sudah running di port 3306

### **3. Cek Database**

Penting! Pastikan database sudah di-import:

**A. Buka phpMyAdmin:**

```
http://localhost/phpmyadmin
```

**B. Cek apakah ada database `db_wms_gudang`:**

- Lihat di sidebar kiri
- Jika tidak ada, import file `database_import.sql`

---

## 📝 Cara Import Database:

**Metode 1: Via Import Tab**

1. Klik tab **"Import"**
2. Klik **"Choose File"**
3. Pilih: `C:\xampp\htdocs\prototipe-v1\database_import.sql`
4. Klik **"Go"**

**Metode 2: Via SQL Tab**

1. Klik tab **"SQL"**
2. Buka file `database_import.sql` dengan Notepad
3. Copy semua isinya
4. Paste di text area SQL
5. Klik **"Go"**

---

## ✅ Setelah Import, Verifikasi:

Di phpMyAdmin, klik database `db_wms_gudang`, harus ada:

1. **Tabel: users**

   - Jumlah row: 1
   - Username: admin123

2. **Tabel: barang**

   - Jumlah row: 11
   - Ada kode: AA001, AA002, AA003, dll

3. **Tabel: penerimaan**

   - Jumlah row: 0 (kosong, siap untuk input)

4. **Tabel: pengeluaran**
   - Jumlah row: 0 (kosong, siap untuk input)

---

## 🚀 Langkah Selanjutnya:

Setelah database verified:

1. Buka: `http://localhost/prototipe-v1/`
2. Login dengan: admin123 / 123456789
3. Enjoy aplikasi WMS!
