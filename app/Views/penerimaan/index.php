<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?= $this->include('layout/sidebar') ?>

<div class="container-fluid">
    <div class="page-header mb-4">
        <h2><i class="fas fa-arrow-down"></i> Terima Barang</h2>
        <p class="text-muted">Input Barang Masuk ke Gudang</p>
    </div>

    <div class="row">
        <!-- Form Input -->
        <div class="col-md-12">
            <div class="stat-card mb-4">
                <h5><i class="fas fa-plus-circle"></i> Form Terima Barang</h5>
                <hr>

                <form action="<?= base_url('penerimaan/store') ?>" method="post">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-truck"></i> Nama Supplier</label>
                            <select class="form-select" name="supplier" required>
                                <option value="">Pilih Supplier</option>
                                <option value="Intan Karton">Intan Karton</option>
                                <option value="Inter Plackban">Inter Plackban</option>
                                <option value="MSI Series">MSI Series</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Penerimaan</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fas fa-barcode"></i> Kode Penerimaan</label>
                            <input type="text" class="form-control" name="kode_penerimaan" placeholder="TRM-001" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fas fa-file-alt"></i> Nomor SJ</label>
                            <input type="text" class="form-control" name="nomor_sj" placeholder="SJ-001">
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label"><i class="fas fa-file-invoice"></i> Nomor PO</label>
                            <input type="text" class="form-control" name="nomor_po" placeholder="PO-001" id="nomor_po">
                            <small class="text-muted">(Opsional - jika ada)</small>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-box"></i> Kode Barang</label>
                            <select class="form-select" name="kode_barang" id="kode_barang" required>
                                <option value="">Pilih Kode Barang</option>
                                <?php foreach ($barang as $b): ?>
                                    <option value="<?= $b['kode_barang'] ?>"><?= $b['kode_barang'] ?> - <?= $b['nama_barang'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-calculator"></i> Jumlah</label>
                            <input type="number" class="form-control" name="jumlah" placeholder="0" min="1" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-save"></i> Simpan Penerimaan
                    </button>
                    <button type="reset" class="btn btn-secondary">
                        <i class="fas fa-redo"></i> Reset
                    </button>
                </form>
            </div>
        </div>

        <!-- Tabel History -->
        <div class="col-md-12">
            <div class="stat-card">
                <h5><i class="fas fa-history"></i> Riwayat Penerimaan</h5>
                <hr>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Supplier</th>
                                <th>Kode Penerimaan</th>
                                <th>Barang</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($penerimaan)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data penerimaan</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($penerimaan as $p): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($p['tanggal'])) ?></td>
                                        <td><?= $p['supplier'] ?></td>
                                        <td><?= $p['kode_penerimaan'] ?></td>
                                        <td><?= $p['nama_barang'] ?></td>
                                        <td class="text-center"><strong><?= $p['jumlah'] ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>