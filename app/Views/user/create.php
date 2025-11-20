<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - WMS Gudang</title>

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
            max-width: 450px;
            padding: 0 15px;
        }

        .form-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            border-radius: 15px 15px 0 0;
        }

        .password-toggle {
            cursor: pointer;
            color: #6c757d;
            transition: color 0.3s;
        }

        .password-toggle:hover {
            color: #495057;
        }

        .input-group-text {
            background-color: white;
            border-left: none;
        }

        .form-control:focus + .input-group-text {
            border-color: #86b7fe;
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
        <div class="form-card">
            <div class="form-header text-center">
                <i class="fas fa-user-plus fa-3x mb-3"></i>
                <h3>Tambah User Baru</h3>
                <p class="mb-0">Warehouse Management System</p>
                <?php 
                $currentKey = $currentKey ?? (getenv('user.admin.secret') ?: 'admin123456');
                ?>
                <a href="<?= base_url('user/index?key=' . $currentKey) ?>" class="back-link mt-3 d-inline-block">
                    <i class="fas fa-arrow-left"></i> Kembali
                </a>
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

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle"></i>
                        <ul class="mb-0">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php 
                $currentKey = $currentKey ?? (getenv('user.admin.secret') ?: 'admin123456');
                ?>
                <form action="<?= base_url('user/store?key=' . $currentKey) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="key" value="<?= esc($currentKey, 'attr') ?>">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Username</label>
                        <input type="text" class="form-control" name="username" 
                               value="<?= old('username') ?>" 
                               placeholder="Masukkan username" required autofocus>
                        <small class="text-muted">Minimal 3 karakter, maksimal 50 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password" 
                                   placeholder="Masukkan password" required>
                            <span class="input-group-text password-toggle" id="togglePassword">
                                <i class="fas fa-eye" id="eyeIcon"></i>
                            </span>
                        </div>
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" 
                                   placeholder="Masukkan ulang password" required>
                            <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-save"></i> Tambah User
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        });

        // Toggle confirm password visibility
        document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
            const confirmPasswordInput = document.getElementById('confirmPassword');
            const eyeIconConfirm = document.getElementById('eyeIconConfirm');
            
            if (confirmPasswordInput.type === 'password') {
                confirmPasswordInput.type = 'text';
                eyeIconConfirm.classList.remove('fa-eye');
                eyeIconConfirm.classList.add('fa-eye-slash');
            } else {
                confirmPasswordInput.type = 'password';
                eyeIconConfirm.classList.remove('fa-eye-slash');
                eyeIconConfirm.classList.add('fa-eye');
            }
        });
    </script>
</body>

</html>

