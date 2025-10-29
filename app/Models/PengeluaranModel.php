<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table            = 'pengeluaran';
    protected $primaryKey       = 'id_pengeluaran';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nomor_bon', 'tujuan_wip', 'tanggal_bon', 'kode_barang', 'jumlah_keluar'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'nomor_bon' => 'required|max_length[20]',
        'tujuan_wip' => 'required|max_length[50]',
        'tanggal_bon' => 'required',
        'kode_barang' => 'required|max_length[10]',
        'jumlah_keluar' => 'required|integer',
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

    public function getPengeluaranWithBarang()
    {
        return $this->select('pengeluaran.*, barang.nama_barang')
            ->join('barang', 'barang.kode_barang = pengeluaran.kode_barang')
            ->orderBy('pengeluaran.tanggal_bon', 'DESC')
            ->findAll();
    }
}
