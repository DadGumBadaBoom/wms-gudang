<?php

namespace App\Controllers;

use App\Models\PenerimaanModel;
use App\Models\BarangModel;
use CodeIgniter\Controller;

class PenerimaanController extends Controller
{
    protected $penerimaanModel;
    protected $barangModel;

    public function __construct()
    {
        $this->penerimaanModel = new PenerimaanModel();
        $this->barangModel = new BarangModel();
    }

    public function index()
    {
        // Check session
        if (!session()->has('user_id')) {
            return redirect()->to('/auth');
        }

        $data = [
            'username' => session()->get('username'),
            'barang' => $this->barangModel->findAll(),
            'penerimaan' => $this->penerimaanModel->getPenerimaanWithBarang(),
        ];

        return view('penerimaan/index', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'supplier' => 'required',
            'tanggal' => 'required',
            'kode_penerimaan' => 'required',
            'kode_barang' => 'required',
            'jumlah' => 'required|integer',
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if ($this->penerimaanModel->where('kode_penerimaan', $this->request->getPost('kode_penerimaan'))->countAllResults() > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Kode Penerimaan sudah pernah digunakan. Harap gunakan kode unik!');
        }

        $data = [
            'supplier' => $this->request->getPost('supplier'),
            'tanggal' => $this->request->getPost('tanggal'),
            'kode_penerimaan' => $this->request->getPost('kode_penerimaan'),
            'nomor_sj' => $this->request->getPost('nomor_sj'),
            'nomor_po' => $this->request->getPost('nomor_po'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'jumlah' => $this->request->getPost('jumlah'),
        ];

        // Simpan data penerimaan
        $this->penerimaanModel->insert($data);

        // Update stok barang
        $this->barangModel->updateStok($data['kode_barang'], $data['jumlah'], 'tambah');

        return redirect()->to('/penerimaan')
            ->with('success', 'Data penerimaan berhasil disimpan dan stok barang diperbarui.');
    }

    public function getByPo()
    {
        $nomor_po = $this->request->getPost('nomor_po');
        // Ini adalah contoh, sesuaikan dengan logika PO Anda
        // Anda bisa membuat tabel PO terpisah jika diperlukan
        return $this->response->setJSON(['kode_barang' => '', 'nama_barang' => '', 'jumlah' => '']);
    }
}
