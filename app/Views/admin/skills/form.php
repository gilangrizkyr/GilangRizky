<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <h1 class="admin-title">
        <?= $title ?>
    </h1>
    <a href="<?= base_url('admin/skills') ?>" class="nav-link"
        style="margin-top: 1rem; display: inline-flex; padding-left: 0;">&larr; Back to List</a>
</div>

<div class="admin-card">
    <form
        action="<?= isset($skill) ? base_url('admin/skills/update/' . $skill['id']) : base_url('admin/skills/create') ?>"
        method="post">
        <?= csrf_field() ?>

        <div style="margin-bottom: 2rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Skill
                Name</label>
            <input type="text" name="title" value="<?= esc($skill['title'] ?? '') ?>" class="comment-input" required
                placeholder="e.g. PHP, React, UI Design">
        </div>

        <div style="margin-bottom: 2rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Icon
                URL (SVG/PNG)</label>
            <input type="text" name="external_icon_url" value="<?= esc($skill['external_icon_url'] ?? '') ?>"
                class="comment-input" placeholder="https://cdn.example.com/icon.svg">
            <small style="display: block; margin-top: 0.5rem; color: var(--text-dim); font-size: 0.7rem;">Leave blank to
                use default icon.</small>
        </div>

        <div style="margin-bottom: 3rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Sort
                Order</label>
            <input type="number" name="sort_order" value="<?= esc($skill['sort_order'] ?? '0') ?>" class="comment-input"
                required>
        </div>

        <button type="submit" class="btn-admin">
            <?= isset($skill) ? 'Update Skill' : 'Create Skill' ?>
        </button>
    </form>
</div>
<?= $this->endSection() ?>