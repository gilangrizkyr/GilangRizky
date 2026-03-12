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
                            <img src="<?= (str_starts_with($bio['photo'], 'http') || str_starts_with($bio['photo'], 'data:')) ? esc($bio['photo']) : base_url(esc($bio['photo'])) ?>"
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
                            <img src="<?= (str_starts_with($bio['lanyard_photo'], 'http') || str_starts_with($bio['lanyard_photo'], 'data:')) ? esc($bio['lanyard_photo']) : base_url(esc($bio['lanyard_photo'])) ?>"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Open Graph (Link Preview) -->
        <div style="margin-bottom: 3rem;">
            <div
                style="background: linear-gradient(to right, rgba(59, 130, 246, 0.05), rgba(0,0,0,0)); padding: 2.5rem; border-radius: 2rem; border: 1px solid rgba(59, 130, 246, 0.2);">
                <h3
                    style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.2em; color: #3b82f6; margin-bottom: 2rem; font-weight: 800; display: flex; align-items: center; gap: 0.8rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                    </svg>
                    Social Media Preview (Open Graph)
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 300px; gap: 3rem; align-items: start;">
                    <div>
                        <p style="color: var(--text-dim); font-size: 0.75rem; margin-bottom: 1.5rem; line-height: 1.6;">
                            This image will appear when you share your portfolio link on WhatsApp, LinkedIn, or Twitter.
                            Recommended size: <strong>1200 x 630 pixels</strong>.
                        </p>

                        <label
                            style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 0.8rem; font-weight: 800;">Upload
                            Thumbnail</label>
                        <input type="file" name="og_image_upload" class="comment-input" style="padding: 1rem 0;">

                        <label
                            style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin: 1.5rem 0 0.8rem; font-weight: 800;">OR
                            Thumbnail URL</label>
                        <input type="text" name="og_image" value="<?= esc($bio['og_image'] ?? '') ?>"
                            class="comment-input" placeholder="https://example.com/social-preview.jpg">
                    </div>

                    <div>
                        <label
                            style="display: block; font-size: 0.6rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-dim); margin-bottom: 1rem; font-weight: 800; text-align: center;">Preview</label>
                        <div
                            style="aspect-ratio: 1.91 / 1; width: 100%; border-radius: 1rem; overflow: hidden; border: 1px solid var(--border); background: #000; display: flex; align-items: center; justify-content: center;">
                            <?php if (!empty($bio['og_image'])): ?>
                                <img src="<?= (str_starts_with($bio['og_image'], 'http') || str_starts_with($bio['og_image'], 'data:')) ? esc($bio['og_image']) : base_url(esc($bio['og_image'])) ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            <?php else: ?>
                                <div style="color: #333; font-size: 0.7rem; font-style: italic;">No thumbnail set</div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-admin">Save Changes</button>
    </form>
</div>
<?= $this->endSection() ?>