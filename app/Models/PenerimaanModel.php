<?php

namespace App\Models;

use CodeIgniter\Model;

class PenerimaanModel extends Model
{
    protected $table            = 'penerimaan';
    protected $primaryKey       = 'id_penerimaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['supplier', 'tanggal', 'kode_penerimaan', 'nomor_sj', 'nomor_po', 'kode_barang', 'jumlah'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules = [
        'supplier' => 'required|max_length[50]',
        'tanggal' => 'required',
        'kode_penerimaan' => 'required|max_length[20]',
        'nomor_sj' => 'permit_empty|max_length[20]',
        'nomor_po' => 'permit_empty|max_length[20]',
        'kode_barang' => 'required|max_length[10]',
        'jumlah' => 'required|integer',
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

    public function getPenerimaanWithBarang()
    {
        return $this->select('penerimaan.*, barang.nama_barang')
            ->join('barang', 'barang.kode_barang = penerimaan.kode_barang')
            ->orderBy('penerimaan.tanggal', 'DESC')
            ->findAll();
    }
}
