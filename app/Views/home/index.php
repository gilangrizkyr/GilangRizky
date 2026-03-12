<?php $this->extend('layouts/main') ?>
<?php $this->section('content') ?>

<?php
$bioName = field($bio, 'name', 'Gilang Rizky');
$bioTitle = field($bio, 'title', 'Full-Stack Developer & Creative Engineer');
$bioPhoto = field($bio, 'photo', '');
$lanyardPhoto = field($bio, 'lanyard_photo', '');
$bioGH = field($bio, 'github_url', 'https://github.com/gilangrizkyr');

// Splitting name for Hero Title
$nameParts = explode(' ', $bioName);
$firstName = esc(strtoupper($nameParts[0] ?? 'GILANG'));
$otherNames = array_slice($nameParts, 1);
$lastName = !empty($otherNames) ? esc(strtoupper(implode(' ', $otherNames))) : '';
?>

<!-- ══════════════════════════════════════════
     HERO SECTION
═══════════════════════════════════════════ -->
<section class="hero">
    <div class="hero-inner">
        <!-- Left: Text -->
        <div class="stagger-reveal">
            <div class="hero-tag reveal-3d">
                <span></span>
                Available For Hire
            </div>

            <h1 class="hero-title reveal-3d">
                <?= $firstName ?><br>
                <?php if ($lastName): ?>
                    <span class="gradient-text"><?= $lastName ?></span>
                <?php endif; ?>
            </h1>

            <p class="hero-desc reveal-3d">
                Building Scalable Web Applications &amp;<br>
                <strong>Modern Full-Stack Development.</strong>
            </p>

            <div class="hero-btns reveal-3d">
                <a href="#works" class="btn-primary">Explore Works</a>
                <a href="<?= esc($bioGH) ?>" target="_blank" rel="noopener" class="btn-secondary">View GitHub</a>
            </div>
        </div>

        <!-- Right: Photo -->
        <div class="hero-photo-wrap zoom-blur">
            <div class="hero-photo-glow"></div>
            <div class="hero-photo scroll-tilt parallax-wrap glass-panel-3d">
                <?php if ($bioPhoto): ?>
                    <img src="<?= (str_starts_with($bioPhoto, 'http') || str_starts_with($bioPhoto, 'data:')) ? esc($bioPhoto) : base_url(esc($bioPhoto)) ?>"
                        alt="<?= esc($bioName) ?>" class="parallax-layer">
                <?php else: ?>
                    <div class="hero-photo-placeholder">G.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Scroll indicator -->
    <!-- <div class="scroll-indicator" aria-hidden="true">
        <div class="scroll-mouse">
            <div class="scroll-dot"></div>
        </div>
    </div> -->
</section>


<!-- ══════════════════════════════════════════
     SKILLS MARQUEE SECTION
═══════════════════════════════════════════ -->
<section class="skills-section">
    <div class="skills-header reveal-3d">
        <span class="section-label">Expertise</span>
        <h2 class="section-title">CORE STACK</h2>
        <p class="section-desc">Professional tools &amp; engineering excellence.</p>
    </div>

    <?php
    $half = (int) ceil(count($skills) / 2);
    $row1 = array_slice($skills, 0, $half);
    $row2 = array_slice($skills, $half);
    ?>

    <div class="marquee-wrap">
        <!-- Row 1: Left -->
        <div class="marquee-track">
            <div class="marquee-content">
                <?php foreach ($row1 as $skill):
                    $icon = is_array($skill) ? ($skill['external_icon_url'] ?? $skill['icon'] ?? '') : ($skill->external_icon_url ?? $skill->icon ?? '');
                    $name = is_array($skill) ? ($skill['title'] ?? '') : ($skill->title ?? ''); ?>
                    <div class="skill-card">
                        <?php if ($icon): ?>
                            <img src="<?= esc($icon) ?>" alt="<?= esc($name) ?>" loading="lazy">
                        <?php endif; ?>
                        <span>
                            <?= esc($name) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Row 2: Right -->
        <div class="marquee-track">
            <div class="marquee-content reverse">
                <?php foreach ($row2 as $skill):
                    $icon = is_array($skill) ? ($skill['external_icon_url'] ?? $skill['icon'] ?? '') : ($skill->external_icon_url ?? $skill->icon ?? '');
                    $name = is_array($skill) ? ($skill['title'] ?? '') : ($skill->title ?? ''); ?>
                    <div class="skill-card">
                        <?php if ($icon): ?>
                            <img src="<?= esc($icon) ?>" alt="<?= esc($name) ?>" loading="lazy">
                        <?php endif; ?>
                        <span>
                            <?= esc($name) ?>
                        </span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>


<!-- ══════════════════════════════════════════
     SELECTED PROJECTS
═══════════════════════════════════════════ -->
<section id="works" class="projects-section">
    <div class="projects-header reveal-3d">
        <div class="projects-header-left">
            <span class="section-label">Selected Works</span>
            <h2 class="section-title">PROJECTS</h2>
            <p class="projects-header-text">Archive of high-end digital experiences crafted with precision.</p>
        </div>
        <a href="<?= base_url('projects') ?>" class="projects-link">All Projects &rarr;</a>
    </div>

    <div class="projects-list">
        <?php if (empty($projects)): ?>
            <p class="no-projects" style="text-align: center; color: var(--text-dim); font-style: italic; padding: 4rem 0;">
                No projects have been shared yet. Stay tuned for my latest works!
            </p>
        <?php else: ?>
            <?php foreach ($projects as $i => $p):
                $isReverse = $i % 2 !== 0;
                $ptitle = is_array($p) ? ($p['title'] ?? '') : ($p->title ?? '');
                $pslug = is_array($p) ? ($p['slug'] ?? '') : ($p->slug ?? '');
                $pimg = is_array($p) ? ($p['main_image'] ?? '') : ($p->main_image ?? '');
                $pdesc = is_array($p) ? ($p['description'] ?? '') : ($p->description ?? '');
                $ptechRaw = is_array($p) ? ($p['tech_stack'] ?? '[]') : ($p->tech_stack ?? '[]');
                $ptech = is_string($ptechRaw) ? (json_decode($ptechRaw, true) ?? []) : (is_array($ptechRaw) ? $ptechRaw : []);
                $pgithub = is_array($p) ? ($p['github'] ?? '#') : ($p->github ?? '#');
                $plink = is_array($p) ? ($p['link'] ?? '#') : ($p->link ?? '#');
                ?>
                <div class="project-item<?= $isReverse ? ' reverse' : '' ?> zoom-blur">
                    <!-- Image Wrapper with Tilt -->
                    <div class="project-image-wrap scroll-tilt parallax-wrap">
                        <div class="project-image glass-panel-3d">
                            <?php if ($pimg): ?>
                                <img src="<?= (str_starts_with($pimg, 'http') || str_starts_with($pimg, 'data:')) ? esc($pimg) : base_url(esc($pimg)) ?>"
                                    alt="<?= esc($ptitle) ?>" loading="lazy">
                            <?php else: ?>
                                <div
                                    style="width:100%;height:100%;background:#0a0a0a;display:flex;align-items:center;justify-content:center;color:#333;font-style:italic;font-size:.8rem;">
                                    No Image</div>
                            <?php endif; ?>
                            <div class="project-image-overlay">
                                <a href="<?= esc($pgithub) ?>" target="_blank" rel="noopener" title="GitHub">
                                    <!-- GitHub icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                        <path
                                            d="M12 0C5.37 0 0 5.37 0 12c0 5.3 3.438 9.8 8.207 11.387.6.113.793-.26.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.085 1.84 1.237 1.84 1.237 1.07 1.834 2.807 1.304 3.49.997.108-.776.42-1.305.762-1.604C7.145 17.12 4.343 16.1 4.343 11.5c0-1.31.469-2.381 1.237-3.221-.124-.303-.536-1.524.117-3.176 0 0 1.008-.322 3.3 1.23A11.51 11.51 0 0112 6.803c1.02.005 2.047.138 3.006.404 2.29-1.552 3.297-1.23 3.297-1.23.655 1.652.243 2.873.12 3.176.77.84 1.235 1.911 1.235 3.221 0 4.61-2.807 5.625-5.48 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576C20.566 21.797 24 17.3 24 12 24 5.37 18.627 0 12 0z" />
                                    </svg>
                                </a>
                                <a href="<?= esc($plink) ?>" target="_blank" rel="noopener" title="Live Demo">
                                    <!-- External link icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor" stroke-width="2.5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M13.5 6H5.25A2.25 2.25 0 003 8.25v10.5A2.25 2.25 0 005.25 21h10.5A2.25 2.25 0 0018 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="project-content">
                        <div class="project-tags">
                            <?php foreach ($ptech as $tag): ?>
                                <span class="project-tag">
                                    <?= esc($tag) ?>
                                </span>
                            <?php endforeach; ?>
                        </div>
                        <a href="<?= base_url('projects/' . esc($pslug)) ?>" style="text-decoration:none;color:inherit;">
                            <h3 class="project-name">
                                <?= esc($ptitle) ?>
                            </h3>
                        </a>
                        <p class="project-desc">
                            <?= esc($pdesc) ?>
                        </p>
                        <div class="project-line"></div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</section>


<!-- ══════════════════════════════════════════
     3D BADGE + COMMENTS SECTION
═══════════════════════════════════════════ -->
<!-- ─── RECONSTRUCTED DISCUSSION SECTION (3-BOX GRID) ─── -->
<section id="discussion" class="discussion-section">
    <div class="discussion-grid">

        <!-- 1. Badge Box -->
        <div class="grid-box badge-box container-p-3d tilt-in-left">
            <div class="badge-canvas-wrap">
                <canvas id="badge-canvas"
                    data-photo="<?= $lanyardPhoto ? ((str_starts_with($lanyardPhoto, 'http') || str_starts_with($lanyardPhoto, 'data:')) ? esc($lanyardPhoto) : base_url(esc($lanyardPhoto))) : ($bioPhoto ? ((str_starts_with($bioPhoto, 'http') || str_starts_with($bioPhoto, 'data:')) ? esc($bioPhoto) : base_url(esc($bioPhoto))) : base_url('assets/images/profile.jpg')) ?>"></canvas>
            </div>
            <div class="badge-label-v2">
                <small>Creative Developer</small>
                <h4><?= esc($bio['name'] ?? 'Gilang Rizky') ?></h4>
            </div>
        </div>

        <!-- 2. Form Box -->
        <div class="grid-box form-box container-p-3d tilt-in-right">
            <div class="discussion-header-v3">
                <div class="glass-icon-circle">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                    </svg>
                </div>
                <div class="header-text">
                    <h3 class="discussion-title-v3">Post Message</h3>
                    <p class="discussion-meta-v3">Direct digital note to the developer team.</p>
                </div>
            </div>

            <form id="comment-form" class="premium-form-v3" novalidate>
                <?= csrf_field() ?>
                <div class="form-group-v3">
                    <input type="text" id="comment-name" name="name" class="minimal-input" placeholder="Your Name"
                        autocomplete="name">
                </div>
                <div class="form-group-v3">
                    <textarea id="comment-text" name="text" class="minimal-textarea"
                        placeholder="Write your message here..." required></textarea>
                </div>
                <div class="form-action-row">
                    <button type="submit" class="premium-submit">
                        <span>Send Comments</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2.5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                        </svg>
                    </button>
                </div>
            </form>

            <div class="form-footer-v3">
                <div class="footer-divider"></div>
                <div class="footer-meta-row">
                    <div class="meta-item">
                        <span class="meta-dot"></span>
                        <span class="meta-label">Status:</span>
                        <span class="meta-value">Operational</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-dot"></span>
                        <span class="meta-label">Latency:</span>
                        <span class="meta-value">~24ms</span>
                    </div>
                    <div class="meta-item">
                        <span class="meta-dot"></span>
                        <span class="meta-label">Protocol:</span>
                        <span class="meta-value">AES-256</span>
                    </div>
                </div>
                <p class="footer-notice">Your message will be processed through our secure digital relay and await
                    community audit before deployment.</p>
            </div>
        </div>

        <!-- 3. Archive Box (Full Width Below) -->
        <div class="grid-box archive-box container-p-3d fade-up">
            <div class="discussion-header-v3">
                <div class="glass-icon-circle archive-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div class="header-text">
                    <h3 class="discussion-title-v3">Conversation History</h3>
                    <p class="discussion-meta-v3">Reviewing the digital logs of community interactions.</p>
                </div>
            </div>

            <div id="comment-list" class="comments-list">
                <?php if (empty($comments)): ?>
                    <div class="no-comments-v2">
                        <div class="empty-slate-glass">
                            <p>No messages yet. Be the first to start the conversation!</p>
                        </div>
                    </div>
                <?php else: ?>
                    <?php foreach ($comments as $c):
                        $cname = is_array($c) ? ($c['name'] ?? 'Anonymous') : ($c->name ?? 'Anonymous');
                        $ctext = is_array($c) ? ($c['text'] ?? '') : ($c->text ?? '');
                        $cdate = is_array($c) ? ($c['created_at'] ?? '') : ($c->created_at ?? '');
                        $ctime = $cdate ? date('d M Y', strtotime($cdate)) : 'Baru saja';
                        ?>
                        <div class="comment-item">
                            <div class="comment-avatar">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                                </svg>
                            </div>
                            <div class="comment-body">
                                <div class="comment-meta">
                                    <span class="comment-name"><?= esc($cname) ?></span>
                                    <span class="comment-time"><?= esc($ctime) ?></span>
                                </div>
                                <p class="comment-text"><?= esc($ctext) ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>

    </div>
</section>

<?php $this->endSection() ?>