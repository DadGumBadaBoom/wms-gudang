<div class="sidebar" style="width: 250px; padding: 20px 0;">
    <div class="text-center mb-4">
        <h4 class="mb-0"><i class="fas fa-warehouse"></i> WMS</h4>
        <small class="text-muted">Warehouse Management</small>
    </div>

    <hr class="bg-light">

    <nav class="nav flex-column px-3">
        <a class="nav-link <?= uri_string() == 'dashboard' ? 'active' : '' ?>" href="<?= base_url('dashboard') ?>">
            <i class="fas fa-home me-2"></i> Dashboard
        </a>
        <a class="nav-link <?= uri_string() == 'barang' ? 'active' : '' ?>" href="<?= base_url('barang') ?>">
            <i class="fas fa-boxes me-2"></i> Aset Gudang
        </a>
        <a class="nav-link <?= uri_string() == 'penerimaan' ? 'active' : '' ?>" href="<?= base_url('penerimaan') ?>">
            <i class="fas fa-arrow-right me-2"></i> Terima Barang
        </a>
        <a class="nav-link <?= uri_string() == 'pengeluaran' ? 'active' : '' ?>" href="<?= base_url('pengeluaran') ?>">
            <i class="fas fa-arrow-left me-2"></i> Barang Keluar
        </a>

        <hr class="bg-light mt-3">

        <div class="px-3 mt-2">
            <p class="small text-white mb-1"><i class="fas fa-user"></i> <?= session()->get('username') ?></p>
            <a href="<?= base_url('auth/logout') ?>" class="btn btn-sm btn-outline-light w-100">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </nav>
</div>