-- ===========================================
-- Database Setup untuk WMS Gudang
-- Import file ini di phpMyAdmin
-- ===========================================

-- Buat Database (jika belum ada)
CREATE DATABASE IF NOT EXISTS `db_wms_gudang` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

-- Gunakan Database
USE `db_wms_gudang`;

-- ===========================================
-- TABLE: users
-- ===========================================
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert User Default (username: admin123, password: 123456789)
INSERT INTO `users` (`username`, `password`) VALUES
('admin123', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- ===========================================
-- TABLE: barang
-- ===========================================
CREATE TABLE IF NOT EXISTS `barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `kode_barang` varchar(10) NOT NULL,
  `nama_barang` varchar(100) NOT NULL,
  `stok_akhir` int(11) DEFAULT '0',
  PRIMARY KEY (`id_barang`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert Master Data Barang
INSERT INTO `barang` (`kode_barang`, `nama_barang`, `stok_akhir`) VALUES
('AA001', 'Karton Laptop Asus 14 Inch', 100),
('AA002', 'Karton Laptop Asus 15 Inch', 100),
('AA003', 'Karton Laptop Asus 16 Inch', 100),
('AA004', 'Plastik Internal All Asus Series', 100),
('AA005', 'Karton Laptop MSI Katana Series', 100),
('AA006', 'Karton Laptop Bravo Series', 100),
('AA007', 'Karton Laptop Intelegance Series', 100),
('AA008', 'Karton Laptop Titan New', 50),
('AA009', 'Plastik Internal Black MSI Series', 50),
('AA010', 'Plastik Internal Transparant MSI All', 50),
('AA011', 'Plackband Karton Brown', 50);

-- ===========================================
-- TABLE: penerimaan
-- ===========================================
CREATE TABLE IF NOT EXISTS `penerimaan` (
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ===========================================
-- TABLE: pengeluaran
-- ===========================================
CREATE TABLE IF NOT EXISTS `pengeluaran` (
  `id_pengeluaran` int(11) NOT NULL AUTO_INCREMENT,
  `nomor_bon` varchar(20) NOT NULL,
  `tujuan_wip` varchar(50) NOT NULL,
  `tanggal_bon` date NOT NULL,
  `kode_barang` varchar(10) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  PRIMARY KEY (`id_pengeluaran`),
  KEY `kode_barang` (`kode_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ===========================================
-- Database Setup Selesai!
-- ===========================================
-- Total tabel yang dibuat: 4
-- Total data master barang: 11
-- User default: admin123 / 123456789
-- ===========================================

