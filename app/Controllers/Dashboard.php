<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\PenerimaanModel;
use App\Models\PengeluaranModel;
use CodeIgniter\Controller;

/**
 * Controller dashboard - menampilkan statistik aplikasi
 */
class Dashboard extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/auth');
        }

        $barangModel = new BarangModel();
        $penerimaanModel = new PenerimaanModel();
        $pengeluaranModel = new PengeluaranModel();

        $data = [
            'username' => session()->get('username'),
            'total_barang' => $barangModel->countAllResults(),
            'total_penerimaan' => $penerimaanModel->countAllResults(),
            'total_pengeluaran' => $pengeluaranModel->countAllResults(),
            'barang_stok_min' => $barangModel->where('stok_akhir <', 10)->countAllResults(),
        ];

        return view('dashboard/index', $data);
    }
}
