<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <h1 class="admin-title">Overview</h1>
    <p style="color: var(--text-muted); font-size: 0.9rem;">Quick stats and system status.</p>
</div>

<div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem;">
    <div class="admin-card">
        <small style="text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); font-weight: 800;">Total
            Projects</small>
        <div style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem;">
            <?= $stats['projects'] ?>
        </div>
    </div>
    <div class="admin-card">
        <small style="text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); font-weight: 800;">Total
            Skills</small>
        <div style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem;">
            <?= $stats['skills'] ?>
        </div>
    </div>
    <div class="admin-card">
        <small style="text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); font-weight: 800;">Total
            Comments</small>
        <div style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem;">
            <?= $stats['comments'] ?>
        </div>
    </div>
    <div class="admin-card"
        style="<?= $stats['pending_comments'] > 0 ? 'border-color: #a855f7; box-shadow: 0 0 20px rgba(168, 85, 247, 0.1);' : '' ?>">
        <small
            style="text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); font-weight: 800;">Pending
            Comments</small>
        <div
            style="font-size: 3rem; font-weight: 900; margin-top: 0.5rem; color: <?= $stats['pending_comments'] > 0 ? '#a855f7' : 'inherit' ?>;">
            <?= $stats['pending_comments'] ?>
        </div>
        <?php if ($stats['pending_comments'] > 0): ?>
            <a href="<?= base_url('admin/comments') ?>"
                style="font-size: 0.7rem; color: #a855f7; text-decoration: none; font-weight: 700; margin-top: 1rem; display: block;">Review
                Now &rarr;</a>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>