<?php $this->extend('layouts/main') ?>
<?php $this->section('content') ?>

<?php
$ptitle = is_array($project) ? ($project['title'] ?? '') : ($project->title ?? '');
$pimg = is_array($project) ? ($project['main_image'] ?? '') : ($project->main_image ?? '');
$pdesc = is_array($project) ? ($project['description'] ?? '') : ($project->description ?? '');
$pbody = is_array($project) ? ($project['body'] ?? '') : ($project->body ?? '');
$pgithub = is_array($project) ? ($project['github'] ?? '#') : ($project->github ?? '#');
$plink = is_array($project) ? ($project['link'] ?? '#') : ($project->link ?? '#');
$ptechRaw = is_array($project) ? ($project['tech_stack'] ?? '[]') : ($project->tech_stack ?? '[]');
$ptech = is_string($ptechRaw) ? (json_decode($ptechRaw, true) ?? []) : (is_array($ptechRaw) ? $ptechRaw : []);
?>

<div class="project-detail">
    <div class="project-detail-inner">

        <!-- Back Link -->
        <a href="<?= base_url('projects') ?>" class="back-link">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
            </svg>
            Back to All Projects
        </a>

        <!-- Title -->
        <h1 class="detail-title">
            <?= esc($ptitle) ?>
        </h1>

        <!-- Tech Tags -->
        <div class="detail-tags">
            <?php foreach ($ptech as $tag): ?>
                <span class="detail-tag">
                    <?= esc($tag) ?>
                </span>
            <?php endforeach; ?>
        </div>

        <!-- Links -->
        <div class="detail-links">
            <?php if ($pgithub && $pgithub !== '#'): ?>
                <a href="<?= esc($pgithub) ?>" target="_blank" rel="noopener" class="detail-link">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path
                            d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.207 11.387.6.113.793-.26.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.085 1.84 1.237 1.84 1.237 1.07 1.834 2.807 1.304 3.49.997.108-.776.42-1.305.762-1.604C7.145 17.12 4.343 16.1 4.343 11.5c0-1.31.469-2.381 1.237-3.221-.124-.303-.536-1.524.117-3.176 0 0 1.008-.322 3.3 1.23A11.51 11.51 0 0112 6.803c1.02.005 2.047.138 3.006.404 2.29-1.552 3.297-1.23 3.297-1.23.655 1.652.243 2.873.12 3.176.77.84 1.235 1.911 1.235 3.221 0 4.61-2.807 5.625-5.48 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12 24 5.37 18.627 0 12 0z" />
                    </svg>
                    GitHub
                </a>
            <?php endif; ?>
            <?php if ($plink && $plink !== '#'): ?>
                <a href="<?= esc($plink) ?>" target="_blank" rel="noopener" class="detail-link">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2.5">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                    </svg>
                    Live Demo
                </a>
            <?php endif; ?>
        </div>

        <!-- Image -->
        <?php if ($pimg): ?>
            <div class="detail-img">
                <img src="<?= esc($pimg) ?>" alt="<?= esc($ptitle) ?>">
            </div>
        <?php endif; ?>

        <!-- Body Content -->
        <div class="detail-body">
            <?php if ($pbody): ?>
                <?= $pbody /* already HTML from seeder, no esc */ ?>
            <?php elseif ($pdesc): ?>
                <p>
                    <?= esc($pdesc) ?>
                </p>
            <?php endif; ?>
        </div>

    </div>
</div>

<?php $this->endSection() ?>