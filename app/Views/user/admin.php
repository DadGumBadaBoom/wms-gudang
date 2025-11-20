<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin User Management - WMS Gudang</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px 0;
        }

        .admin-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            margin: 0 auto;
        }

        .admin-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
        }

        .table-responsive {
            max-height: 500px;
            overflow-y: auto;
        }

        .btn-action {
            padding: 5px 10px;
            margin: 0 2px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="admin-card">
            <div class="admin-header">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3><i class="fas fa-user-shield"></i> Admin User Management</h3>
                        <p class="mb-0">Kelola semua user di sistem</p>
                    </div>
                    <div>
                        <a href="<?= base_url('auth') ?>" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>

            <div class="p-4">
                <?php if (session()->getFlashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle"></i> <?= session()->getFlashdata('success') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="mb-0">Daftar User</h5>
                    <?php 
                    $secretKey = getenv('user.admin.secret') ?: 'admin123456';
                    ?>
                    <a href="<?= base_url('user/create?key=' . $secretKey) ?>" class="btn btn-primary">
                        <i class="fas fa-user-plus"></i> Tambah User
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($users)): ?>
                                <tr>
                                    <td colspan="3" class="text-center text-muted">
                                        <i class="fas fa-info-circle"></i> Belum ada user
                                    </td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= $user['id_user'] ?></td>
                                        <td><strong><?= esc($user['username']) ?></strong></td>
                                        <td class="text-center">
                                            <?php 
                                            $secretKey = getenv('user.admin.secret') ?: 'admin123456';
                                            ?>
                                            <a href="<?= base_url('user/edit/' . $user['id_user'] . '?key=' . $secretKey) ?>" 
                                               class="btn btn-warning btn-sm btn-action" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <a href="<?= base_url('user/delete/' . $user['id_user'] . '?key=' . $secretKey) ?>" 
                                               class="btn btn-danger btn-sm btn-action" 
                                               title="Hapus"
                                               onclick="return confirm('Yakin ingin menghapus user <?= esc($user['username']) ?>?')">
                                                <i class="fas fa-trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

