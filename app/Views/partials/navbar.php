<nav class="navbar">
    <a href="<?= base_url('/') ?>" class="navbar-logo" aria-label="Home">G.</a>
    <ul class="navbar-links">
        <li><a href="<?= base_url('/#works') ?>">Projects</a></li>
        <?php
        $navBio = $bio ?? [];
        $navGH = is_array($navBio) ? ($navBio['github_url'] ?? '#') : ($navBio->github_url ?? '#');
        $navIG = is_array($navBio) ? ($navBio['instagram_url'] ?? '') : ($navBio->instagram_url ?? '');
        $navEmail = is_array($navBio) ? ($navBio['email'] ?? '') : ($navBio->email ?? '');
        ?>
        <li><a href="<?= esc($navGH) ?>" target="_blank" rel="noopener">GitHub</a></li>
        <?php if ($navIG): ?>
            <li><a href="<?= esc($navIG) ?>" target="_blank" rel="noopener">Instagram</a></li>
        <?php endif; ?>
        <?php if ($navEmail): ?>
            <li><a href="mailto:<?= esc($navEmail) ?>">Email</a></li>
        <?php endif; ?>
    </ul>
</nav>