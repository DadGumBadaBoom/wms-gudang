<?= $this->include('layout/header') ?>

<div class="main-content">
    <div class="top-bar">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <?php if (isset($page_title)): ?>
                    <i class="fas fa-<?= $page_title_icon ?? 'file' ?>"></i> <?= $page_title ?>
                <?php else: ?>
                    <i class="fas fa-home"></i> Dashboard
                <?php endif; ?>
            </h5>
            <span class="text-muted">
                <i class="fas fa-clock"></i> <?= date('d/m/Y H:i') ?>
            </span>
        </div>
    </div>

    <!-- Flash Messages -->
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
            <i class="fas fa-exclamation-circle"></i> <strong>Terjadi Kesalahan:</strong>
            <ul class="mb-0 mt-2">
                <?php foreach (session()->getFlashdata('errors') as $error): ?>
                    <li><?= is_array($error) ? implode(', ', $error) : $error ?></li>
                <?php endforeach; ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- Content -->
    <?= $this->renderSection('content') ?>
</div>

<?= $this->include('layout/footer') ?>