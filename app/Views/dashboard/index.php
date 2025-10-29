<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?= $this->include('layout/sidebar') ?>

<div class="container-fluid">
    <div class="page-header mb-4">
        <h2><i class="fas fa-home"></i> Dashboard</h2>
        <p class="text-muted">Selamat datang, <strong><?= $username ?></strong></p>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon text-primary">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3 class="mt-3"><?= $total_barang ?></h3>
                <p class="text-muted mb-0">Total Barang</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon text-success">
                    <i class="fas fa-arrow-down"></i>
                </div>
                <h3 class="mt-3"><?= $total_penerimaan ?></h3>
                <p class="text-muted mb-0">Penerimaan</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon text-danger">
                    <i class="fas fa-arrow-up"></i>
                </div>
                <h3 class="mt-3"><?= $total_pengeluaran ?></h3>
                <p class="text-muted mb-0">Pengeluaran</p>
            </div>
        </div>

        <div class="col-md-3">
            <div class="stat-card text-center">
                <div class="stat-icon text-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                <h3 class="mt-3"><?= $barang_stok_min ?></h3>
                <p class="text-muted mb-0">Stok Minimal</p>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <div class="stat-card">
                <h5><i class="fas fa-info-circle"></i> Informasi Sistem</h5>
                <hr>
                <p><strong>Nama Sistem:</strong> WMS Gudang</p>
                <p><strong>Versi:</strong> 1.0.0</p>
                <p><strong>Fitur Utama:</strong></p>
                <ul>
                    <li>Manajemen Aset Gudang</li>
                    <li>Penerimaan Barang</li>
                    <li>Barang Keluar (Bon Produksi)</li>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <div class="stat-card">
                <h5><i class="fas fa-chart-line"></i> Statistik Hari Ini</h5>
                <hr>
                <p>Penerimaan hari ini: <strong>0</strong> transaksi</p>
                <p>Pengeluaran hari ini: <strong>0</strong> transaksi</p>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>