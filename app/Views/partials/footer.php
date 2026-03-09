<?php $b = $bio ?? [];
$github = is_array($b) ? ($b['github_url'] ?? '#') : ($b->github_url ?? '#');
$ig = is_array($b) ? ($b['instagram_url'] ?? '') : ($b->instagram_url ?? '');
$email = is_array($b) ? ($b['email'] ?? '') : ($b->email ?? ''); ?>
<footer class="footer">
    <span class="footer-logo">G.</span>
    <p class="footer-copy">Crafted with precision &bull;
        <?= date('Y') ?>
    </p>
    <div class="footer-links">
        <a href="<?= esc($github) ?>" target="_blank" rel="noopener">GitHub</a>
        <?php if ($ig): ?><a href="<?= esc($ig) ?>" target="_blank" rel="noopener">Instagram</a>
        <?php endif; ?>
        <?php if ($email): ?><a href="mailto:<?= esc($email) ?>">Email</a>
        <?php endif; ?>
    </div>
</footer>