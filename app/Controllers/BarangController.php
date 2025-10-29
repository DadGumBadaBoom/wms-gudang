<?php

namespace App\Controllers;

use App\Models\BarangModel;
use CodeIgniter\Controller;

class BarangController extends Controller
{
    protected $barangModel;

    public function __construct()
    {
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
        ];

        return view('barang/index', $data);
    }

    public function getByKode()
    {
        $kode_barang = $this->request->getPost('kode_barang');
        $barang = $this->barangModel->getBarangByKode($kode_barang);

        return $this->response->setJSON($barang);
    }
}
