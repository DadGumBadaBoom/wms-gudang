<?= $this->extend('layout/main') ?>
<?= $this->section('content') ?>

<?= $this->include('layout/sidebar') ?>

<div class="container-fluid">
    <div class="page-header mb-4">
        <h2><i class="fas fa-arrow-up"></i> Barang Keluar (Bon Produksi)</h2>
        <p class="text-muted">Kirim Barang ke WIP</p>
    </div>

    <div class="row">
        <!-- Form Header Bon -->
        <div class="col-md-12">
            <div class="stat-card mb-4">
                <h5><i class="fas fa-paper-plane"></i> Form Bon Pengiriman</h5>
                <hr>

                <form id="formBon">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-barcode"></i> Nomor Bon</label>
                            <input type="text" class="form-control" name="nomor_bon" placeholder="BON-001" id="nomor_bon" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-map-marker-alt"></i> Kirim ke WIP</label>
                            <select class="form-select" name="tujuan_wip" id="tujuan_wip" required>
                                <option value="">Pilih Tujuan</option>
                                <option value="WIP Locky 1">WIP Locky 1</option>
                                <option value="WIP Locky 2">WIP Locky 2</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label"><i class="fas fa-calendar"></i> Tanggal Bon</label>
                            <input type="date" class="form-control" name="tanggal_bon" id="tanggal_bon" value="<?= date('Y-m-d') ?>" required>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label d-block">&nbsp;</label>
                            <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#modalBarangKeluar">
                                <i class="fas fa-plus"></i> Tambah Barang Keluar
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Daftar Barang yang akan dikirim -->
                <div id="listBarangKeluar" class="table-responsive mt-3">
                    <h6>Barang yang akan dikirim:</h6>
                    <table class="table table-sm" id="tabelBarangKeluar">
                        <thead class="table-secondary">
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th class="text-center">Jumlah</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center text-muted">Belum ada barang dipilih</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tabel History -->
        <div class="col-md-12">
            <div class="stat-card">
                <h5><i class="fas fa-history"></i> Riwayat Pengeluaran</h5>
                <hr>

                <div class="table-responsive">
                    <table class="table table-sm table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Tanggal</th>
                                <th>Nomor Bon</th>
                                <th>Tujuan WIP</th>
                                <th>Barang</th>
                                <th class="text-center">Jumlah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($pengeluaran)): ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada data pengeluaran</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($pengeluaran as $p): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($p['tanggal_bon'])) ?></td>
                                        <td><?= $p['nomor_bon'] ?></td>
                                        <td><?= $p['tujuan_wip'] ?></td>
                                        <td><?= $p['nama_barang'] ?></td>
                                        <td class="text-center"><strong><?= $p['jumlah_keluar'] ?></strong></td>
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

<!-- Modal Tambah Barang Keluar -->
<div class="modal fade" id="modalBarangKeluar" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-box"></i> Tambah Barang Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="formBarangKeluar">
                    <div class="mb-3">
                        <label class="form-label">Kode Barang</label>
                        <select class="form-select" name="kode_barang" id="kode_barang_modal" required>
                            <option value="">Pilih Kode Barang</option>
                            <?php foreach ($barang as $b): ?>
                                <option value="<?= $b['kode_barang'] ?>" data-nama="<?= $b['nama_barang'] ?>" data-stok="<?= $b['stok_akhir'] ?>">
                                    <?= $b['kode_barang'] ?> - <?= $b['nama_barang'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control" id="nama_barang_display" readonly>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jumlah Barang Keluar</label>
                        <input type="number" class="form-control" name="jumlah_keluar" id="jumlah_keluar" min="1" required>
                        <small class="text-muted">Stok tersedia: <span id="stok_tersedia" class="badge bg-info">0</span></small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary" onclick="addBarangKeluar()">
                    <i class="fas fa-plus"></i> Tambah ke List
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let listBarangKeluar = [];

    // Update nama barang dan stok saat pilih kode barang
    $('#kode_barang_modal').change(function() {
        const selected = $(this).find('option:selected');
        $('#nama_barang_display').val(selected.data('nama'));
        $('#stok_tersedia').text(selected.data('stok'));
        $('#jumlah_keluar').attr('max', selected.data('stok'));
    });

    function addBarangKeluar() {
        const kode_barang = $('#kode_barang_modal').val();
        const selected = $('#kode_barang_modal option:selected');
        const nama_barang = $('#nama_barang_display').val();
        const jumlah = parseInt($('#jumlah_keluar').val());
        const stok = parseInt($('#stok_tersedia').text());

        if (!kode_barang || !jumlah || jumlah < 1) {
            alert('Harap lengkapi semua field!');
            return;
        }

        if (jumlah > stok) {
            alert('Jumlah keluar melebihi stok tersedia!');
            return;
        }

        // Tambah ke list sementara
        const item = {
            kode_barang: kode_barang,
            nama_barang: nama_barang,
            jumlah: jumlah
        };

        listBarangKeluar.push(item);

        // Update tabel
        updateTabelBarangKeluar();

        // Reset form dan close modal
        $('#kode_barang_modal').val('');
        $('#nama_barang_display').val('');
        $('#jumlah_keluar').val('');
        $('#stok_tersedia').text('0');
        $('#modalBarangKeluar').modal('hide');
    }

    function updateTabelBarangKeluar() {
        const tbody = $('#tabelBarangKeluar tbody');
        tbody.empty();

        if (listBarangKeluar.length === 0) {
            tbody.html('<tr><td colspan="4" class="text-center text-muted">Belum ada barang dipilih</td></tr>');
        } else {
            listBarangKeluar.forEach((item, index) => {
                tbody.append(`
                <tr>
                    <td>${item.kode_barang}</td>
                    <td>${item.nama_barang}</td>
                    <td class="text-center"><strong>${item.jumlah}</strong></td>
                    <td class="text-center">
                        <button class="btn btn-sm btn-danger" onclick="removeBarangKeluar(${index})">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
            });

            // Tambah tombol submit
            if ($('#btnSubmitBon').length === 0) {
                tbody.append(`
                <tr>
                    <td colspan="4" class="text-center">
                        <button type="button" class="btn btn-success" id="btnSubmitBon" onclick="submitBon()">
                            <i class="fas fa-paper-plane"></i> Kirim Barang ke WIP
                        </button>
                    </td>
                </tr>
            `);
            }
        }
    }

    function removeBarangKeluar(index) {
        listBarangKeluar.splice(index, 1);
        updateTabelBarangKeluar();
    }

    function submitBon() {
        if (listBarangKeluar.length === 0) {
            alert('Tidak ada barang yang akan dikirim!');
            return;
        }

        if (!confirm('Yakin ingin mengirim barang ini ke WIP?')) {
            return;
        }

        // Submit setiap barang ke server
        let successCount = 0;
        let errorCount = 0;

        listBarangKeluar.forEach(item => {
            $.ajax({
                url: '<?= base_url('pengeluaran/store') ?>',
                type: 'POST',
                data: {
                    nomor_bon: $('#nomor_bon').val(),
                    tujuan_wip: $('#tujuan_wip').val(),
                    tanggal_bon: $('#tanggal_bon').val(),
                    kode_barang: item.kode_barang,
                    jumlah_keluar: item.jumlah
                },
                success: function() {
                    successCount++;
                },
                error: function() {
                    errorCount++;
                },
                complete: function() {
                    if (successCount + errorCount === listBarangKeluar.length) {
                        if (errorCount === 0) {
                            alert('Semua barang berhasil dikirim!');
                            location.reload();
                        } else {
                            alert('Beberapa barang gagal dikirim!');
                        }
                    }
                }
            });
        });
    }
</script>
<?= $this->endSection() ?>