<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?= $this->include('layout/sidebar') ?>

<div class="container-fluid">
    <div class="page-header mb-4">
        <h2><i class="fas fa-boxes"></i> Aset Gudang</h2>
        <p class="text-muted">Daftar Stok Barang di Gudang</p>
    </div>

    <div class="stat-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="mb-0"><i class="fas fa-list"></i> Daftar Barang</h5>
            <button class="btn btn-sm btn-primary" onclick="location.reload()">
                <i class="fas fa-sync"></i> Refresh
            </button>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th width="10%">No</th>
                        <th width="15%">Kode Barang</th>
                        <th>Nama Barang</th>
                        <th width="15%" class="text-center">Stok Akhir</th>
                        <th width="15%" class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($barang as $b): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><strong><?= $b['kode_barang'] ?></strong></td>
                            <td><?= $b['nama_barang'] ?></td>
                            <td class="text-center">
                                <span class="badge bg-<?= $b['stok_akhir'] < 10 ? 'danger' : 'success' ?> fs-6">
                                    <?= $b['stok_akhir'] ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <?php if ($b['stok_akhir'] < 10): ?>
                                    <span class="badge bg-warning"><i class="fas fa-exclamation"></i> Stok Minim</span>
                                <?php else: ?>
                                    <span class="badge bg-success"><i class="fas fa-check"></i> Normal</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>