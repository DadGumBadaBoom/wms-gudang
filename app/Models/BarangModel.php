<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table            = 'barang';
    protected $primaryKey       = 'id_barang';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['kode_barang', 'nama_barang', 'stok_akhir'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'kode_barang' => 'required|max_length[10]',
        'nama_barang' => 'required|max_length[100]',
        'stok_akhir' => 'permit_empty',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function updateStok($kode_barang, $jumlah, $jenis = 'tambah')
    {
        $barang = $this->where('kode_barang', $kode_barang)->first();

        if ($barang) {
            if ($jenis === 'tambah') {
                $stok_baru = $barang['stok_akhir'] + $jumlah;
            } else {
                $stok_baru = $barang['stok_akhir'] - $jumlah;

                // Validasi stok tidak boleh negatif
                if ($stok_baru < 0) {
                    return false;
                }
            }

            $this->update($barang['id_barang'], ['stok_akhir' => $stok_baru]);
            return true;
        }

        return false;
    }

    public function getBarangByKode($kode_barang)
    {
        return $this->where('kode_barang', $kode_barang)->first();
    }
}
