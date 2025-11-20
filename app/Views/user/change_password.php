<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password - WMS Gudang</title>

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
                <i class="fas fa-key fa-3x mb-3"></i>
                <h3>Ganti Password</h3>
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
                                <li><?= esc($error) ?></li>
                            <?php endforeach; ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <form action="<?= base_url('user/update-password?key=' . $currentKey) ?>" method="post">
                    <?= csrf_field() ?>
                    <input type="hidden" name="key" value="<?= esc($currentKey, 'attr') ?>">
                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-user"></i> Username</label>
                        <input type="text" class="form-control" name="username" 
                               value="<?= old('username') ?>" 
                               placeholder="Masukkan username" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password Lama</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="oldPassword" name="old_password" 
                                   placeholder="Masukkan password lama" required>
                            <span class="input-group-text password-toggle" id="toggleOldPassword">
                                <i class="fas fa-eye" id="eyeIconOld"></i>
                            </span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword" name="new_password" 
                                   placeholder="Masukkan password baru" required>
                            <span class="input-group-text password-toggle" id="toggleNewPassword">
                                <i class="fas fa-eye" id="eyeIconNew"></i>
                            </span>
                        </div>
                        <small class="text-muted">Minimal 6 karakter</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label"><i class="fas fa-lock"></i> Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword" name="confirm_password" 
                                   placeholder="Masukkan ulang password baru" required>
                            <span class="input-group-text password-toggle" id="toggleConfirmPassword">
                                <i class="fas fa-eye" id="eyeIconConfirm"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">
                        <i class="fas fa-save"></i> Ganti Password
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle old password visibility
        document.getElementById('toggleOldPassword').addEventListener('click', function() {
            const oldPasswordInput = document.getElementById('oldPassword');
            const eyeIconOld = document.getElementById('eyeIconOld');
            
            if (oldPasswordInput.type === 'password') {
                oldPasswordInput.type = 'text';
                eyeIconOld.classList.remove('fa-eye');
                eyeIconOld.classList.add('fa-eye-slash');
            } else {
                oldPasswordInput.type = 'password';
                eyeIconOld.classList.remove('fa-eye-slash');
                eyeIconOld.classList.add('fa-eye');
            }
        });

        // Toggle new password visibility
        document.getElementById('toggleNewPassword').addEventListener('click', function() {
            const newPasswordInput = document.getElementById('newPassword');
            const eyeIconNew = document.getElementById('eyeIconNew');
            
            if (newPasswordInput.type === 'password') {
                newPasswordInput.type = 'text';
                eyeIconNew.classList.remove('fa-eye');
                eyeIconNew.classList.add('fa-eye-slash');
            } else {
                newPasswordInput.type = 'password';
                eyeIconNew.classList.remove('fa-eye-slash');
                eyeIconNew.classList.add('fa-eye');
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

