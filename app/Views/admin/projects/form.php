<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <h1 class="admin-title">
        <?= $title ?>
    </h1>
    <a href="<?= base_url('admin/projects') ?>" class="nav-link"
        style="margin-top: 1rem; display: inline-flex; padding-left: 0;">&larr; Back to List</a>
</div>

<div class="admin-card">
    <form
        action="<?= isset($project) ? base_url('admin/projects/update/' . $project['id']) : base_url('admin/projects/create') ?>"
        method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>

        <div style="margin-bottom: 2rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Project
                Title</label>
            <input type="text" name="title" value="<?= esc($project['title'] ?? '') ?>" class="comment-input" required
                placeholder="e.g. E-Commerce Platform">
        </div>

        <div style="margin-bottom: 2rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Description</label>
            <textarea name="description" class="comment-textarea" required style="min-height: 120px;"
                placeholder="Brief overview of the project..."><?= esc($project['description'] ?? '') ?></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">GitHub
                    Repo URL</label>
                <input type="url" name="github" value="<?= esc($project['github'] ?? '') ?>" class="comment-input"
                    placeholder="https://github.com/user/repo">
            </div>
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Live
                    Link</label>
                <input type="url" name="link" value="<?= esc($project['link'] ?? '') ?>" class="comment-input"
                    placeholder="https://project.com">
            </div>
        </div>

        <div style="margin-bottom: 2rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Tech
                Stack (Comma separated)</label>
            <input type="text" name="tech_stack" value="<?= esc($project['tech_stack'] ?? '') ?>" class="comment-input"
                placeholder="PHP, React, MySQL, AWS">
        </div>

        <div style="margin-bottom: 3rem;">
            <label
                style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Main
                Image</label>

            <div
                style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: 1rem; border: 1px solid var(--border);">
                <label
                    style="display: block; font-size: 0.6rem; color: var(--text-dim); margin-bottom: 0.5rem; font-weight: 800;">UPLOAD
                    FILE</label>
                <input type="file" name="main_image" class="comment-input" style="padding: 1rem 0;">

                <label
                    style="display: block; font-size: 0.6rem; color: var(--text-dim); margin: 1rem 0 0.5rem; font-weight: 800;">OR
                    IMAGE URL</label>
                <input type="text" name="main_image_url" value="<?= esc($project['main_image'] ?? '') ?>"
                    class="comment-input" placeholder="https://example.com/image.jpg">
            </div>

            <?php if (isset($project) && $project['main_image']): ?>
                <div
                    style="margin-top: 1rem; width: 200px; border-radius: 1rem; overflow: hidden; border: 1px solid var(--border);">
                    <img src="<?= str_starts_with($project['main_image'], 'http') ? esc($project['main_image']) : base_url($project['main_image']) ?>"
                        style="width: 100%;">
                </div>
                <small style="display: block; margin-top: 0.5rem; color: var(--text-dim); font-size: 0.7rem;">Leave both
                    empty to
                    keep current image.</small>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn-admin">
            <?= isset($project) ? 'Update Project' : 'Create Project' ?>
        </button>
    </form>
</div>
<?= $this->endSection() ?>