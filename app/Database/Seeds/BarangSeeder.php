<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class BarangSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['kode_barang' => 'AA001', 'nama_barang' => 'Karton Laptop Asus 14 Inch', 'stok_akhir' => 0],
            ['kode_barang' => 'AA002', 'nama_barang' => 'Karton Laptop Asus 15 Inch', 'stok_akhir' => 0],
            ['kode_barang' => 'AA003', 'nama_barang' => 'Karton Laptop Asus 16 Inch', 'stok_akhir' => 0],
            ['kode_barang' => 'AA004', 'nama_barang' => 'Plastik Internal All Asus Series', 'stok_akhir' => 0],
            ['kode_barang' => 'AA005', 'nama_barang' => 'Karton Laptop MSI Katana Series', 'stok_akhir' => 0],
            ['kode_barang' => 'AA006', 'nama_barang' => 'Karton Laptop Bravo Series', 'stok_akhir' => 0],
            ['kode_barang' => 'AA007', 'nama_barang' => 'Karton Laptop Intelegance Series', 'stok_akhir' => 0],
            ['kode_barang' => 'AA008', 'nama_barang' => 'Karton Laptop Titan New', 'stok_akhir' => 0],
            ['kode_barang' => 'AA009', 'nama_barang' => 'Plastik Internal Black MSI Series', 'stok_akhir' => 0],
            ['kode_barang' => 'AA010', 'nama_barang' => 'Plastik Internal Transparant MSI All', 'stok_akhir' => 0],
            ['kode_barang' => 'AA011', 'nama_barang' => 'Plackband Karton Brown', 'stok_akhir' => 0],
        ];

        $this->db->table('barang')->insertBatch($data);
    }
}
