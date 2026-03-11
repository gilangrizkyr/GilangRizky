<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <div style="display: flex; justify-content: space-between; align-items: flex-end;">
        <div>
            <h1 class="admin-title">Core Skills</h1>
            <p style="color: var(--text-muted); font-size: 0.9rem;">Manage tools and expertise displayed in the marquee.
            </p>
        </div>
        <a href="<?= base_url('admin/skills/new') ?>" class="btn-admin">Add New Skill</a>
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
                <th width="80">Order</th>
                <th width="60">Icon</th>
                <th>Skill Name</th>
                <th width="200" style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($skills as $s): ?>
                <tr>
                    <td><span style="color: var(--text-dim); font-weight: 800;">#
                            <?= esc($s['sort_order']) ?>
                        </span></td>
                    <td>
                        <?php if ($s['external_icon_url']): ?>
                            <img src="<?= esc($s['external_icon_url']) ?>"
                                style="width: 24px; height: 24px; filter: grayscale(1) invert(1);">
                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td style="font-weight: 700;">
                        <?= esc($s['title']) ?>
                    </td>
                    <td style="text-align: right;">
                        <a href="<?= base_url('admin/skills/edit/' . $s['id']) ?>" class="btn-admin"
                            style="padding: 0.5rem 1rem; font-size: 0.6rem; background: rgba(255,255,255,0.05); color: #fff;">Edit</a>
                        <a href="<?= base_url('admin/skills/delete/' . $s['id']) ?>" class="btn-admin btn-danger"
                            style="padding: 0.5rem 1rem; font-size: 0.6rem;"
                            onclick="return confirm('Hapus skill ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>