<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <h1 class="admin-title">Personal Bio</h1>
    <p style="color: var(--text-muted); font-size: 0.9rem;">Update your name, title, and social links.</p>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div
        style="padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid var(--accent-emerald); color: var(--accent-emerald); border-radius: 1rem; margin-bottom: 2rem; font-size: 0.8rem; font-weight: 700;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="admin-card">
    <form action="<?= base_url('admin/bio/update') ?>" method="post" enctype="multipart/form-data">
        <?= csrf_field() ?>
        <input type="hidden" name="id" value="<?= $bio['id'] ?? '' ?>">

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Full
                    Name</label>
                <input type="text" name="name" value="<?= esc($bio['name'] ?? '') ?>" class="comment-input" required>
            </div>
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Professional
                    Title</label>
                <input type="text" name="title" value="<?= esc($bio['title'] ?? '') ?>" class="comment-input" required>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 2rem; margin-bottom: 2rem;">
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">GitHub
                    URL</label>
                <input type="url" name="github_url" value="<?= esc($bio['github_url'] ?? '') ?>" class="comment-input">
            </div>
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Instagram
                    URL</label>
                <input type="url" name="instagram_url" value="<?= esc($bio['instagram_url'] ?? '') ?>"
                    class="comment-input">
            </div>
            <div>
                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Email
                    Address</label>
                <input type="email" name="email" value="<?= esc($bio['email'] ?? '') ?>" class="comment-input">
            </div>
        </div>

        <div style="margin-bottom: 3rem; display: grid; grid-template-columns: 1fr 1fr; gap: 4rem; align-items: start;">
            <!-- Hero Photo -->
            <div
                style="background: rgba(255,255,255,0.02); padding: 2rem; border-radius: 1.5rem; border: 1px solid var(--border);">
                <h3
                    style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--accent-purple); margin-bottom: 1.5rem; font-weight: 800;">
                    Hero Photo (Top Page)</h3>

                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Upload
                    New</label>
                <input type="file" name="photo_upload" class="comment-input" style="padding: 1rem 0;">

                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin: 1.5rem 0 0.8rem; font-weight: 800;">OR
                    Photo URL</label>
                <input type="text" name="photo" value="<?= esc($bio['photo'] ?? '') ?>" class="comment-input">

                <?php if (!empty($bio['photo'])): ?>
                    <div style="margin-top: 2rem; text-align: center;">
                        <div
                            style="display: inline-block; width: 100px; height: 100px; border-radius: 1.5rem; overflow: hidden; border: 1px solid var(--border); background: #111;">
                            <img src="<?= str_starts_with($bio['photo'], 'http') ? esc($bio['photo']) : base_url($bio['photo']) ?>"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Lanyard Photo -->
            <div
                style="background: rgba(255,255,255,0.02); padding: 2rem; border-radius: 1.5rem; border: 1px solid var(--border);">
                <h3
                    style="font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--accent-emerald); margin-bottom: 1.5rem; font-weight: 800;">
                    Lanyard Photo (Badge)</h3>

                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Upload
                    New</label>
                <input type="file" name="lanyard_photo_upload" class="comment-input" style="padding: 1rem 0;">

                <label
                    style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin: 1.5rem 0 0.8rem; font-weight: 800;">OR
                    Photo URL</label>
                <input type="text" name="lanyard_photo" value="<?= esc($bio['lanyard_photo'] ?? '') ?>"
                    class="comment-input">

                <?php if (!empty($bio['lanyard_photo'])): ?>
                    <div style="margin-top: 2rem; text-align: center;">
                        <div
                            style="display: inline-block; width: 100px; height: 100px; border-radius: 1.5rem; overflow: hidden; border: 1px solid var(--border); background: #111;">
                            <img src="<?= str_starts_with($bio['lanyard_photo'], 'http') ? esc($bio['lanyard_photo']) : base_url($bio['lanyard_photo']) ?>"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <button type="submit" class="btn-admin">Save Changes</button>
    </form>
</div>
<?= $this->endSection() ?>