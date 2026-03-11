<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 class="admin-title">Projects</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Manage your portfolio work and case studies.</p>
        </div>
        <a href="<?= base_url('admin/projects/new') ?>" class="btn-admin">Add New Project</a>
    </div>
</div>

<?php if (session()->getFlashdata('success')): ?>
    <div
        style="padding: 1rem; background: rgba(16, 185, 129, 0.1); border: 1px solid var(--accent-emerald); color: var(--accent-emerald); border-radius: 1rem; margin-bottom: 2rem; font-size: 0.8rem; font-weight: 700;">
        <?= session()->getFlashdata('success') ?>
    </div>
<?php endif; ?>

<div class="admin-card" style="padding: 0;">
    <table>
        <thead>
            <tr>
                <th width="120">Preview</th>
                <th>Project Details</th>
                <th width="150" style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($projects as $p): ?>
                <tr>
                    <td>
                        <div
                            style="width: 100px; height: 60px; border-radius: 0.5rem; overflow: hidden; background: #111; border: 1px solid var(--border);">
                            <?php if ($p['main_image']): ?>
                                <img src="<?= base_url($p['main_image']) ?>"
                                    style="width: 100%; height: 100%; object-fit: cover;">
                            <?php endif; ?>
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 900; font-size: 1rem; margin-bottom: 0.3rem;">
                            <?= esc($p['title']) ?>
                        </div>
                        <div style="color: var(--text-dim); font-size: 0.7rem; display: flex; gap: 1rem;">
                            <span>Slug:
                                <?= esc($p['slug']) ?>
                            </span>
                            <span>Tech:
                                <?= is_array($p['tech_stack']) ? count($p['tech_stack']) : count(json_decode($p['tech_stack'] ?? '[]', true)) ?>
                                items
                            </span>
                        </div>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= base_url('admin/projects/edit/' . $p['id']) ?>" class="btn-admin"
                            style="padding: 0.5rem 1rem; font-size: 0.6rem; background: rgba(255,255,255,0.05); color: #fff;">Edit</a>
                        <a href="<?= base_url('admin/projects/delete/' . $p['id']) ?>" class="btn-admin btn-danger"
                            style="padding: 0.5rem 1rem; font-size: 0.6rem;"
                            onclick="return confirm('Hapus project ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>