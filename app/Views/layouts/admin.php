<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $title ?? 'Admin' ?> | Portfolio
    </title>
    <link rel="stylesheet" href="<?= base_url('assets/css/style.css') ?>">
    <style>
        :root {
            --sidebar-width: 280px;
        }

        body {
            background: #030303;
            color: #fff;
            display: flex;
        }

        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            background: rgba(10, 10, 10, 0.8);
            backdrop-filter: blur(20px);
            border-right: 1px solid var(--border);
            padding: 2rem;
            display: flex;
            flex-direction: column;
            z-index: 100;
        }

        .admin-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 4rem;
            min-height: 100vh;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.5rem;
            color: rgba(255, 255, 255, 0.5);
            text-decoration: none;
            border-radius: 1rem;
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link:hover,
        .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
        }

        .nav-link svg {
            opacity: 0.7;
            transition: transform 0.3s;
        }

        .nav-link:hover svg,
        .nav-link.active svg {
            opacity: 1;
            transform: scale(1.1);
            color: var(--accent-blue, #3b82f6);
        }

        .admin-header {
            margin-bottom: 3rem;
        }

        .admin-title {
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: -0.04em;
            text-transform: uppercase;
        }

        .admin-card {
            background: rgba(20, 20, 20, 0.4);
            border: 1px solid var(--border);
            border-radius: 2rem;
            padding: 2rem;
            backdrop-filter: blur(20px);
        }

        .btn-admin {
            padding: 0.8rem 1.5rem;
            background: #fff;
            color: #000;
            border: none;
            border-radius: 0.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.7rem;
        }

        .btn-danger {
            background: #ef4444;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 2rem;
        }

        th {
            text-align: left;
            padding: 1rem;
            color: var(--text-dim);
            font-size: 0.6rem;
            text-transform: uppercase;
            letter-spacing: 0.2rem;
            border-bottom: 1px solid var(--border);
        }

        td {
            padding: 1.2rem 1rem;
            font-size: 0.85rem;
            border-bottom: 1px solid var(--border);
        }

        /* Enhanced Admin Form Elements */
        .admin-card input,
        .admin-card textarea,
        .admin-card select {
            width: 100%;
            background: rgba(255, 255, 255, 0.03) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            border-radius: 12px !important;
            padding: 1rem 1.25rem !important;
            color: #fff !important;
            font-size: 0.9rem !important;
            transition: all 0.3s ease;
        }

        .admin-card input:focus,
        .admin-card textarea:focus,
        .admin-card select:focus {
            outline: none !important;
            border-color: var(--accent-blue) !important;
            background: rgba(255, 255, 255, 0.05) !important;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.15);
        }

        .admin-card label {
            display: block;
            font-size: 0.65rem;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            color: rgba(255, 255, 255, 0.4);
            margin-bottom: 0.75rem;
            font-weight: 800;
        }
    </style>
</head>

<body>
    <div class="aurora">
        <div class="aurora-blob aurora-blob-1"></div>
        <div class="aurora-blob aurora-blob-3"></div>
    </div>

    <aside class="admin-sidebar glass-panel-3d">
        <div style="font-size: 1.5rem; font-weight: 950; margin-bottom: 3rem; letter-spacing: -0.05em;">
            <span style="color: var(--accent-blue);">G.</span> ADMIN
        </div>
        <nav style="display: flex; flex-direction: column; gap: 0.5rem; flex: 1;">
            <a href="<?= base_url('admin') ?>"
                class="nav-link <?= current_url() == base_url('admin') ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="3" width="7" height="7"></rect>
                    <rect x="14" y="3" width="7" height="7"></rect>
                    <rect x="14" y="14" width="7" height="7"></rect>
                    <rect x="3" y="14" width="7" height="7"></rect>
                </svg>
                Dashboard
            </a>
            <a href="<?= base_url('admin/bio') ?>"
                class="nav-link <?= strpos(current_url(), 'admin/bio') !== false ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                    <circle cx="12" cy="7" r="4"></circle>
                </svg>
                Bio
            </a>
            <a href="<?= base_url('admin/skills') ?>"
                class="nav-link <?= strpos(current_url(), 'admin/skills') !== false ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
                Skills
            </a>
            <a href="<?= base_url('admin/projects') ?>"
                class="nav-link <?= strpos(current_url(), 'admin/projects') !== false ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="2" y="3" width="20" height="14" rx="2" ry="2"></rect>
                    <line x1="8" y1="21" x2="16" y2="21"></line>
                    <line x1="12" y1="17" x2="12" y2="21"></line>
                </svg>
                Projects
            </a>
            <a href="<?= base_url('admin/comments') ?>"
                class="nav-link <?= strpos(current_url(), 'admin/comments') !== false ? 'active' : '' ?>">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path
                        d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z">
                    </path>
                </svg>
                Comments
            </a>
        </nav>
        <a href="<?= base_url('logout') ?>" class="nav-link" style="color: #ef4444; margin-top: auto;">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                <polyline points="16 17 21 12 16 7"></polyline>
                <line x1="21" y1="12" x2="9" y2="12"></line>
            </svg>
            Logout
        </a>
    </aside>

    <main class="admin-main">
        <div class="reveal-3d in-view">
            <?php if (strpos($_SERVER['HTTP_HOST'] ?? '', 'vercel.app') !== false): ?>
                <div
                    style="background: rgba(245, 158, 11, 0.1); border: 1px solid #f59e0b; color: #f59e0b; padding: 1rem; border-radius: 1rem; margin-bottom: 2rem; font-size: 0.75rem; font-weight: 700; display: flex; align-items: center; gap: 0.8rem;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                        </path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span>VERCEL MODE: Fitur upload file dinonaktifkan (Read-only). Silakan gunakan kolom "Image URL" untuk
                        memperbarui foto.</span>
                </div>
            <?php endif; ?>
            <?= $this->renderSection('content') ?>
        </div>
    </main>

    <?= $this->renderSection('scripts') ?>
</body>

</html>