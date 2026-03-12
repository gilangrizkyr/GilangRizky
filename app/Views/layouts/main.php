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

    <!-- Open Graph / Facebook -->
    <?php
    $ogTitle = isset($page_title) ? esc($page_title) . ' | Gilang Rizky' : 'Gilang Rizky | Full-Stack Developer';
    $ogDesc = isset($meta_desc) ? esc($meta_desc) : 'Portfolio Gilang Rizky – Full-Stack Developer & Creative Engineer';
    $ogImg = base_url('assets/images/opengraph.png');
    ?>
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= current_url() ?>">
    <meta property="og:title" content="<?= $ogTitle ?>">
    <meta property="og:description" content="<?= $ogDesc ?>">
    <meta property="og:image" content="<?= $ogImg ?>">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="<?= current_url() ?>">
    <meta property="twitter:title" content="<?= $ogTitle ?>">
    <meta property="twitter:description" content="<?= $ogDesc ?>">
    <meta property="twitter:image" content="<?= $ogImg ?>">

    <!-- Preconnect & DNS-Prefetch -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="https://cdnjs.cloudflare.com">

    <!-- Preload LCP Image -->
    <?php if (isset($bio['photo']) && $bio['photo']): ?>
        <link rel="preload" as="image"
            href="<?= (str_starts_with($bio['photo'], 'http') || str_starts_with($bio['photo'], 'data:')) ? esc($bio['photo']) : base_url(esc($bio['photo'])) ?>"
            fetchpriority="high">
    <?php endif; ?>

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

    <!-- Three.js CDN (Deferred) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/0.149.0/three.min.js" defer></script>

    <!-- Main JS (Deferred) -->
    <script src="<?= base_url('assets/js/main.js') ?>" defer></script>

    <?= $this->renderSection('scripts') ?>
</body>

</html>