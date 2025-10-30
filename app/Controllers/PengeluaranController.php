<?php

namespace App\Controllers;

use App\Models\PengeluaranModel;
use App\Models\BarangModel;
use CodeIgniter\Controller;

class PengeluaranController extends Controller
{
    protected $pengeluaranModel;
    protected $barangModel;

    public function __construct()
    {
        $this->pengeluaranModel = new PengeluaranModel();
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
            'pengeluaran' => $this->pengeluaranModel->getPengeluaranWithBarang(),
        ];

        return view('pengeluaran/index', $data);
    }

    public function store()
    {
        if (!$this->validate([
            'nomor_bon' => 'required',
            'tujuan_wip' => 'required',
            'tanggal_bon' => 'required',
            'kode_barang' => 'required',
            'jumlah_keluar' => 'required|integer',
        ])) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        if ($this->pengeluaranModel->where('nomor_bon', $this->request->getPost('nomor_bon'))->countAllResults() > 0) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Nomor Bon sudah pernah digunakan. Harap gunakan kode unik!');
        }

        $data = [
            'nomor_bon' => $this->request->getPost('nomor_bon'),
            'tujuan_wip' => $this->request->getPost('tujuan_wip'),
            'tanggal_bon' => $this->request->getPost('tanggal_bon'),
            'kode_barang' => $this->request->getPost('kode_barang'),
            'jumlah_keluar' => $this->request->getPost('jumlah_keluar'),
        ];

        // Cek stok tersedia
        $barang = $this->barangModel->getBarangByKode($data['kode_barang']);
        if ($barang['stok_akhir'] < $data['jumlah_keluar']) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Stok barang tidak mencukupi! Stok tersedia: ' . $barang['stok_akhir']);
        }

        // Simpan data pengeluaran
        $this->pengeluaranModel->insert($data);

        // Update stok barang
        $this->barangModel->updateStok($data['kode_barang'], $data['jumlah_keluar'], 'kurang');

        return redirect()->to('/pengeluaran')
            ->with('success', 'Barang berhasil dikirim ke WIP dan stok barang diperbarui.');
    }
}
