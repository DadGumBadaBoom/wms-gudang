<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - WMS Gudang</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 100%;
            max-width: 500px;
            padding: 0 15px;
        }

        .index-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .index-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
        }

        .menu-item {
            padding: 15px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            margin-bottom: 15px;
            transition: all 0.3s;
            text-decoration: none;
            color: #333;
            display: block;
        }

        .menu-item:hover {
            border-color: #667eea;
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .menu-item i {
            font-size: 1.5rem;
            margin-right: 10px;
            color: #667eea;
        }

        .back-link {
            color: white;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: rgba(255, 255, 255, 0.8);
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="index-card">
            <div class="index-header text-center">
                <i class="fas fa-users fa-3x mb-3"></i>
                <h3>User Management</h3>
                <p class="mb-0">Warehouse Management System</p>
                <a href="<?= base_url('auth') ?>" class="back-link mt-3 d-inline-block">
                    <i class="fas fa-arrow-left"></i> Kembali ke Login
                </a>
            </div>

            <div class="p-4">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i> <?= session()->getFlashdata('error') ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php 
                $currentKey = $currentKey ?? (getenv('user.admin.secret') ?: 'admin123456');
                ?>

                <a href="<?= base_url('user/create?key=' . $currentKey) ?>" class="menu-item">
                    <i class="fas fa-user-plus"></i>
                    <strong>Tambah User Baru</strong>
                    <p class="mb-0 text-muted small">Buat akun user baru untuk login</p>
                </a>

                <a href="<?= base_url('user/change-password?key=' . $currentKey) ?>" class="menu-item">
                    <i class="fas fa-key"></i>
                    <strong>Ganti Password</strong>
                    <p class="mb-0 text-muted small">Ubah password user yang sudah ada</p>
                </a>

                <a href="<?= base_url('user/admin?key=' . $currentKey) ?>" class="menu-item">
                    <i class="fas fa-user-shield"></i>
                    <strong>Admin Panel</strong>
                    <p class="mb-0 text-muted small">Kelola semua user (CRUD lengkap)</p>
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

