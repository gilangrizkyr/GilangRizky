<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="<?= isset($meta_desc) ? esc($meta_desc) : 'Portfolio Gilang Rizky – Full-Stack Developer & Creative Engineer' ?>">
    <title>
        <?= isset($page_title) ? esc($page_title) . ' | ' : '' ?>Gilang Rizky | Portfolio
    </title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= base_url('favicon.png') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">

    <?= $this->renderSection('head') ?>
</head>

<body>
    <!-- Aurora Background -->
    <div class="aurora" aria-hidden="true">
        <div class="aurora-grid"></div>
        <div class="aurora-blob aurora-blob-1"></div>
        <div class="aurora-blob aurora-blob-2"></div>
        <div class="aurora-blob aurora-blob-3"></div>
        <div class="aurora-traveler"></div>
        <div class="aurora-3d-orb aurora-orb-1"></div>
        <div class="aurora-3d-orb aurora-orb-2"></div>
    </div>

    <!-- Navbar -->
    <?= view('partials/navbar', isset($bio) ? ['bio' => $bio] : []) ?>

    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- Footer -->
    <?= view('partials/footer', isset($bio) ? ['bio' => $bio] : []) ?>

    <!-- Three.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.149.0/three.min.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/js/main.js') ?>"></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>