<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>
<div class="admin-header">
    <h1 class="admin-title">Comment Moderation</h1>
    <p style="color: var(--text-muted); font-size: 0.9rem;">Review and approve visitor comments before they go live.</p>
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
                <th width="150">Visitor</th>
                <th>Message</th>
                <th width="150">Date</th>
                <th width="120">Status</th>
                <th width="150" style="text-align: right;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($comments as $c): ?>
                <tr style="<?= $c['approved'] == 0 ? 'background: rgba(168, 85, 247, 0.05);' : '' ?>">
                    <td>
                        <div style="font-weight: 800;">
                            <?= esc($c['name']) ?>
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 0.8rem; color: #ccc; line-height: 1.4;">
                            <?= esc($c['text']) ?>
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 0.7rem; color: var(--text-dim);">
                            <?= date('d M Y, H:i', strtotime($c['created_at'])) ?>
                        </div>
                    </td>
                    <td>
                        <?php if ($c['approved'] == 1): ?>
                            <span
                                style="font-size: 0.6rem; font-weight: 900; background: rgba(16, 185, 129, 0.1); color: var(--accent-emerald); padding: 0.3rem 0.6rem; border-radius: 0.4rem; text-transform: uppercase;">Approved</span>
                        <?php else: ?>
                            <span
                                style="font-size: 0.6rem; font-weight: 900; background: rgba(168, 85, 247, 0.1); color: var(--accent-purple); padding: 0.3rem 0.6rem; border-radius: 0.4rem; text-transform: uppercase;">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td style="text-align: right; display: flex; gap: 0.5rem; justify-content: flex-end;">
                        <?php if ($c['approved'] == 0): ?>
                            <a href="<?= base_url('admin/comments/approve/' . $c['id']) ?>" class="btn-admin"
                                style="padding: 0.5rem 1rem; font-size: 0.6rem; background: var(--accent-purple); color: #fff;">Activate</a>
                        <?php else: ?>
                            <a href="<?= base_url('admin/comments/deactivate/' . $c['id']) ?>" class="btn-admin"
                                style="padding: 0.5rem 1rem; font-size: 0.6rem; background: rgba(255,255,255,0.05); color: #fff; border: 1px solid rgba(255,255,255,0.1);">Deactivate</a>
                        <?php endif; ?>
                        <a href="<?= base_url('admin/comments/delete/' . $c['id']) ?>" class="btn-admin btn-danger"
                            style="padding: 0.5rem 1rem; font-size: 0.6rem;"
                            onclick="return confirm('Hapus komentar ini?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?= $this->endSection() ?>