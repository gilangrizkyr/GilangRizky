<nav class="navbar">
    <a href="<?= base_url('/') ?>" class="navbar-logo" aria-label="Home">G.</a>
    <ul class="navbar-links">
        <li><a href="<?= base_url('/#works') ?>">Projects</a></li>
        <?php $navGH = (isset($bio) && (is_array($bio) ? ($bio['github_url'] ?? '#') : ($bio->github_url ?? '#'))) ?: '#'; ?>
        <li><a href="<?= esc($navGH) ?>" target="_blank" rel="noopener">GitHub</a></li>
    </ul>
</nav>