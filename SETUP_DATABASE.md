# 📦 Setup Database WMS Gudang

## 🎯 Cara Import Database ke XAMPP

### **Langkah 1: Buka XAMPP Control Panel**

1. Jalankan **XAMPP Control Panel**
2. Klik **Start** pada **Apache** dan **MySQL**

### **Langkah 2: Buat Database**

1. Buka browser dan akses: `http://localhost/phpmyadmin`
2. Klik tab **Databases**
3. Masukkan nama database: **db_wms_gudang**
4. Pilih Collation: **utf8mb4_general_ci**
5. Klik **Create**

### **Langkah 3: Eksekusi Migration**

Buka **Command Prompt** atau **PowerShell**, masuk ke folder project:

```bash
cd C:\xampp\htdocs\prototipe-v1
php spark migrate
php spark db:seed BarangSeeder
php spark db:seed UserSeeder
```

### **Atau Import Manual via phpMyAdmin**

**Opsi A: Eksekusi File SQL**

1. Buka phpMyAdmin: `http://localhost/phpmyadmin`
2. Pilih database **db_wms_gudang**
3. Klik tab **SQL**
4. Copy paste script berikut:

```sql
-- Buat Table Users
CREATE TABLE `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert User Default
INSERT INTO `users` (`username`, `password`) VALUES
('admin123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Buat Table Barang
CREATE TABLE `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok_akhir` int(11) DEFAULT '0',
  PRIMARY KEY (`id_barang`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert Data Master Barang
INSERT INTO `barang` (`kode_barang`, `nama_barang`, `stok_akhir`) VALUES
('AA001', 'Karton Laptop Asus 14 Inch', 0),
('AA002', 'Karton Laptop Asus 15 Inch', 0),
('AA003', 'Karton Laptop Asus 16 Inch', 0),
('AA004', 'Plastik Internal All Asus Series', 0),
('AA005', 'Karton Laptop MSI Katana Series', 0),
('AA006', 'Karton Laptop Bravo Series', 0),
('AA007', 'Karton Laptop Intelegance Series', 0),
('AA008', 'Karton Laptop Titan New', 0),
('AA009', 'Plastik Internal Black MSI Series', 0),
('AA010', 'Plastik Internal Transparant MSI All', 0),
('AA011', 'Plackband Karton Brown', 0);

-- Buat Table Penerimaan
CREATE TABLE `penerimaan` (
  `id_penerimaan` int(11) NOT NULL AUTO_INCREMENT,
  `supplier` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `kode_penerimaan` varchar(20) NOT NULL,
  `nomor_sj` varchar(20) DEFAULT NULL,
  `nomor_po` varchar(20) DEFAULT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jumlah` int(11) NOT NULL,
  PRIMARY KEY (`id_penerimaan`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Buat Table Pengeluaran
CREATE TABLE `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_bon` varchar(20) NOT NULL,
  `tujuan_wip` varchar(50) NOT NULL,
  `tanggal_bon` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  PRIMARY KEY (`id_pengeluaran`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

5. Klik **Go**

### **Langkah 4: Konfigurasi File .env**

File `.env` sudah ada di folder project. Edit file `.env` dan pastikan konfigurasi database seperti ini:

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

- Jika password MySQL Anda bukan kosong, isi di `database.default.password`
- Sesuaikan `app.baseURL` dengan URL project Anda

### **Langkah 5: Test Aplikasi**

1. Buka browser: `http://localhost/prototipe-v1/`
2. Login dengan:

   - **Username:** `admin123`
   - **Password:** `123456789`

3. Jika berhasil, Anda akan diarahkan ke **Dashboard**

---

## 🔧 Troubleshooting

### **Error: Database tidak ditemukan**

- Pastikan MySQL sudah running di XAMPP
- Pastikan nama database sudah benar: `db_wms_gudang`
- Cek konfigurasi di file `.env`

### **Error: Access denied for user**

- Pastikan username MySQL adalah `root`
- Jika pakai password, update di file `.env`
- Restart XAMPP MySQL

### **Error: 404 Not Found**

- Pastikan `app.baseURL` di `.env` sesuai dengan URL project
- Cek file `app/Config/App.php`

### **Tidak bisa login**

- Pastikan user dengan password hash sudah ada di database
- Password default: `123456789` (hash: bcrypt)

---

## ✅ Checklist Setup Selesai

- [ ] Apache dan MySQL sudah running
- [ ] Database `db_wms_gudang` sudah dibuat
- [ ] Tabel users, barang, penerimaan, pengeluaran sudah ada
- [ ] Data master barang sudah di-insert (11 barang)
- [ ] User default (admin123) sudah ada
- [ ] File `.env` sudah dikonfigurasi
- [ ] Aplikasi bisa diakses via browser
- [ ] Login berhasil masuk ke Dashboard

---

## 🎉 Selamat! Database Anda sudah siap digunakan!

**Next Step:** Mulai menggunakan aplikasi WMS Gudang:

1. Login dengan username `admin123` dan password `123456789`
2. Coba fitur **Aset Gudang** untuk melihat stok barang
3. Coba **Terima Barang** untuk menambah stok
4. Coba **Barang Keluar** untuk mengurangi stok
