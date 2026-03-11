<?php $this->extend('layouts/main') ?>
<?php $this->section('content') ?>

<div class="projects-page">
    <div class="projects-page-inner">
        <a href="<?= base_url('/') ?>" class="back-link reveal-3d">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to Home
        </a>
        <h1 class="page-title fade-up">ALL PROJECTS</h1>

        <div class="projects-grid">
            <?php if (empty($projects)): ?>
                <p class="empty-notice">No projects have been added yet.</p>
            <?php else: ?>
                <?php foreach ($projects as $p):
                    $ptitle = is_array($p) ? ($p['title'] ?? '') : ($p->title ?? '');
                    $pslug = is_array($p) ? ($p['slug'] ?? '') : ($p->slug ?? '');
                    $pimg = is_array($p) ? ($p['main_image'] ?? '') : ($p->main_image ?? '');
                    $ptechRaw = is_array($p) ? ($p['tech_stack'] ?? '[]') : ($p->tech_stack ?? '[]');
                    $ptech = is_string($ptechRaw) ? (json_decode($ptechRaw, true) ?? []) : (is_array($ptechRaw) ? $ptechRaw : []);
                    ?>
                    <a href="<?= base_url('projects/' . esc($pslug)) ?>" class="project-card">
                        <div class="project-card-img">
                            <?php if ($pimg): ?>
                                <img src="<?= esc($pimg) ?>" alt="<?= esc($ptitle) ?>" loading="lazy">
                            <?php else: ?>
                                <div class="project-card-no-img">No Image</div>
                            <?php endif; ?>
                        </div>
                        <div class="project-card-body">
                            <h2 class="project-card-title">
                                <?= esc($ptitle) ?>
                            </h2>
                            <div class="project-card-tags">
                                <?php foreach (array_slice($ptech, 0, 4) as $tag): ?>
                                    <span class="project-card-tag">
                                        <?= esc($tag) ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $this->endSection() ?>