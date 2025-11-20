# 📝 Panduan User Management - WMS Gudang

## 🔐 Informasi Penting

Halaman user management **TIDAK ditampilkan** di menu navigasi/sidebar aplikasi. Halaman ini hanya dapat diakses melalui URL langsung.

---

## 📋 Struktur Halaman

### ⚠️ **PENTING: Semua Halaman Memerlukan Secret Key!**

Semua halaman user management sekarang **memerlukan secret key** untuk akses. Tidak ada lagi akses publik.

### **1. Halaman Index** (Memerlukan Secret Key)

Halaman index **langsung redirect ke Admin Panel**. Tidak ada menu tambahan.

### **2. Halaman Admin** (Memerlukan Secret Key)

Halaman untuk CRUD lengkap user:

- Lihat semua user
- Tambah user
- Edit user
- Hapus user

### **3. Halaman Ganti Password** (Memerlukan Secret Key)

Halaman untuk mengubah password user yang sudah ada

---

## 🌐 Cara Mengakses

### **A. Halaman Index (Memerlukan Secret Key)**

**URL:**

```
http://localhost/prototipe-v1/user/index?key=YOUR_SECRET_KEY
```

**Default Secret Key:** `admin123456`

**Catatan:** Halaman index **langsung redirect ke Admin Panel**. Semua fitur tersedia di Admin Panel.

---

### **B. Halaman Admin (Memerlukan Secret Key)**

**URL:**

```
http://localhost/prototipe-v1/user/admin?key=YOUR_SECRET_KEY
```

**Default Secret Key:** `admin123456`

**Cara Mengubah Secret Key:**

1. Buka file `.env` di root project
2. Tambahkan baris:
   ```env
   user.admin.secret = "ubah_dengan_key_rahasia_anda"
   ```
3. Simpan file

**Fitur yang tersedia:**

- ✅ Lihat semua user
- ✅ Tambah user baru
- ✅ Edit user (username & password)
- ✅ Hapus user

---

### **C. Halaman Tambah User (Memerlukan Secret Key)**

**URL:**

```
http://localhost/prototipe-v1/user/create?key=YOUR_SECRET_KEY
```

**Field yang Harus Diisi:**

1. **Username**

   - Minimal 3 karakter
   - Maksimal 50 karakter
   - Harus unik (tidak boleh sama dengan username yang sudah ada)

2. **Password**

   - Minimal 6 karakter
   - Dapat dilihat/d disembunyikan dengan klik ikon mata

3. **Konfirmasi Password**
   - Harus sama dengan password
   - Dapat dilihat/d disembunyikan dengan klik ikon mata

---

### **D. Halaman Ganti Password (Memerlukan Secret Key)**

**URL:**

```
http://localhost/prototipe-v1/user/change-password?key=YOUR_SECRET_KEY
```

**Field yang Harus Diisi:**

1. **Username** - Username user yang ingin diganti passwordnya
2. **Password Lama** - Password yang sedang digunakan
3. **Password Baru** - Password baru (minimal 6 karakter)
4. **Konfirmasi Password Baru** - Harus sama dengan password baru

---

### **E. Halaman Edit User (Hanya dari Admin)**

**URL:**

```
http://localhost/prototipe-v1/user/edit/ID_USER?key=YOUR_SECRET_KEY
```

**Contoh:**

```
http://localhost/prototipe-v1/user/edit/1?key=admin123456
```

**Fitur:**

- Edit username
- Edit password (opsional, kosongkan jika tidak ingin mengubah)

---

## 📋 Langkah-langkah Penggunaan

### **1. Mengelola User (Admin Panel)**

1. Buka: `http://localhost/prototipe-v1/user/admin?key=admin123456`
   - Atau: `http://localhost/prototipe-v1/user/index?key=admin123456` (akan redirect ke admin)
2. Lihat daftar semua user
3. Klik tombol **"Tambah User"** untuk menambah user baru
4. Klik tombol **Edit** untuk mengubah user (username & password)
5. Klik tombol **Hapus** untuk menghapus user (dengan konfirmasi)

**Catatan:** Semua fitur user management tersedia di Admin Panel, termasuk:

- ✅ Tambah user baru
- ✅ Edit user (username & password)
- ✅ Hapus user

---

## 🔐 Keamanan

### **Secret Key untuk Admin**

- **Default:** `admin123456`
- **Disarankan:** Ubah secret key di file `.env`
- **Jangan share** secret key ke orang yang tidak berwenang
- **Ganti secara berkala** untuk keamanan lebih baik

### **Cara Mengubah Secret Key:**

1. Edit file `.env` di root project
2. Tambahkan:
   ```env
   user.admin.secret = "key_rahasia_baru_anda"
   ```
3. Simpan dan restart aplikasi

### **Catatan Keamanan:**

- **Semua halaman user management memerlukan secret key** untuk akses
- Jika tidak ada secret key, akan diarahkan ke halaman login
- Semua password di-hash dengan bcrypt
- Username harus unik
- Secret key harus di-share hanya ke orang yang berwenang

---

## 🔧 Troubleshooting

### **Error: 404 Not Found**

- Pastikan URL benar
- Pastikan Apache sudah running
- Cek file `.env` apakah `app.baseURL` sudah benar

### **Error: Akses ditolak. Secret key tidak valid**

- Pastikan secret key benar
- Default key: `admin123456`
- Atau cek di file `.env` jika sudah diubah

### **Error: Username sudah digunakan**

- Username harus unik
- Gunakan username yang berbeda

### **Error: Konfirmasi password tidak cocok**

- Pastikan password dan konfirmasi password sama persis
- Perhatikan huruf besar/kecil (case sensitive)

### **Error: Username atau password lama salah**

- Pastikan username benar
- Pastikan password lama benar
- Perhatikan huruf besar/kecil

---

## 📌 Contoh URL Lengkap

Jika aplikasi Anda diakses di:

- `http://localhost/prototipe-v1/` →

  - Index: `http://localhost/prototipe-v1/user/index?key=admin123456`
  - Admin: `http://localhost/prototipe-v1/user/admin?key=admin123456`
  - Ganti Password: `http://localhost/prototipe-v1/user/change-password?key=admin123456`
  - Tambah User: `http://localhost/prototipe-v1/user/create?key=admin123456`

- `http://localhost:8080/prototipe-v1/` →
  - Index: `http://localhost:8080/prototipe-v1/user/index?key=admin123456`
  - Admin: `http://localhost:8080/prototipe-v1/user/admin?key=admin123456`
  - Ganti Password: `http://localhost:8080/prototipe-v1/user/change-password?key=admin123456`
  - Tambah User: `http://localhost:8080/prototipe-v1/user/create?key=admin123456`

---

## 📚 File Dokumentasi Terkait

- `KEAMANAN_USER_MANAGEMENT.md` - Penjelasan lengkap tentang keamanan

---

**Selamat menggunakan fitur User Management! 🎉**
