/* ─── SCROLL ANIMATIONS (Enhanced 3D) ───────────────── */
const scrollObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        // We add 'in-view' when intersecting, and optionally 'out-view' when leaving
        if (entry.isIntersecting) {
            entry.target.classList.add('in-view');
            entry.target.classList.remove('out-view');
        } else {
            // Only add out-view if it was already in-view (scrolled past)
            if (entry.target.classList.contains('in-view') && entry.boundingClientRect.top < 0) {
                entry.target.classList.add('out-view');
                entry.target.classList.remove('in-view');
            } else if (entry.boundingClientRect.top > 0) {
                // Reset if scrolled back up above the element
                entry.target.classList.remove('in-view', 'out-view');
            }
        }
    });
}, {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px' // Trigger slightly before it hits bottom
});

// Select all elements with animation classes
const initAnimations = () => {
    const targets = document.querySelectorAll('.fade-up, .reveal-3d, .tilt-in-left, .tilt-in-right, .zoom-blur, .project-item');
    targets.forEach(el => {
        el.classList.add('scroll-animate');
        scrollObserver.observe(el);
    });
};

/* ─── ULTRA-SMOOTH 3D SCROLL ENGINE (OPTIMIZED) ────── */
const state = {
    scrollPerc: 0,
    lerpedScroll: 0,
    winHeight: window.innerHeight,
    targets: []
};

// Cache elements and their properties
const cacheElements = () => {
    state.targets = Array.from(document.querySelectorAll('.scroll-tilt')).map(el => ({
        el,
        inner: el.querySelector('.parallax-layer'),
        lastTiltX: 0
    }));
};

const handleScroll = () => {
    const winScroll = window.pageYOffset || document.documentElement.scrollTop;
    const scrollHeight = document.documentElement.scrollHeight - window.innerHeight;
    // Fix NaN if scrollHeight is 0
    state.scrollPerc = scrollHeight > 0 ? Math.max(0, Math.min(1, winScroll / scrollHeight)) : 0;
};

window.addEventListener('scroll', handleScroll, { passive: true });

const update3DEffects = () => {
    // 1. Lerp scroll for buttery movement
    if (Math.abs(state.scrollPerc - state.lerpedScroll) > 0.0001) {
        state.lerpedScroll += (state.scrollPerc - state.lerpedScroll) * 0.1;
        document.documentElement.style.setProperty('--scroll-perc', state.lerpedScroll.toFixed(4));

        // 2. Global Perspective Origin Shift (More subtle for stability)
        const originY = 50 + (state.lerpedScroll * 25);
        document.body.style.perspectiveOrigin = `50% ${originY}%`;
    }

    // 3. Batch process tilts from cache
    for (let i = 0; i < state.targets.length; i++) {
        const item = state.targets[i];
        const rect = item.el.getBoundingClientRect();

        // Skip if way off screen
        if (rect.bottom < -100 || rect.top > state.winHeight + 100) continue;

        const center = rect.top + rect.height / 2;
        const diff = (center - (state.winHeight / 2)) / (state.winHeight / 2);

        // Apply tilt (limited to +/- 15deg for professionalism)
        const targetX = -diff * 15;
        item.el.style.setProperty('--tilt-x', `${targetX}deg`);

        // Parallax layer if exists - more subtle vertical move
        if (item.inner) {
            item.inner.style.transform = `translate3d(0, ${diff * -12}px, 30px)`;
        }
    }

    requestAnimationFrame(update3DEffects);
};

// Initialize on load
document.addEventListener('DOMContentLoaded', () => {
    initAnimations();
    cacheElements();
    update3DEffects();
    handleScroll(); // Initial position
});

window.addEventListener('resize', () => {
    state.winHeight = window.innerHeight;
    cacheElements(); // Re-cache if layout changes
});

/* ─── MODERN TOAST NOTIFICATION ─────────────────── */
const showToast = (message, type = 'info') => {
    let container = document.querySelector('.toast-container');
    if (!container) {
        container = document.createElement('div');
        container.className = 'toast-container';
        document.body.appendChild(container);
    }

    const toast = document.createElement('div');
    toast.className = `glass-toast ${type}`;

    // Icon selection based on type
    let icon = '';
    if (type === 'success') {
        icon = `<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M20 6L9 17l-5-5" /></svg>`;
    } else if (type === 'error') {
        icon = `<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" /><line x1="12" y1="8" x2="12" y2="12" /><line x1="12" y1="16" x2="12.01" y2="16" /></svg>`;
    } else {
        icon = `<svg class="toast-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10" /><line x1="12" y1="16" x2="12" y2="12" /><line x1="12" y1="8" x2="12.01" y2="8" /></svg>`;
    }

    toast.innerHTML = `${icon}<span>${message}</span>`;
    container.appendChild(toast);

    // Animate in - reliable timeout
    setTimeout(() => toast.classList.add('active'), 50);

    // Click to dismiss
    toast.addEventListener('click', () => {
        toast.classList.remove('active');
        setTimeout(() => toast.remove(), 500);
    });

    // Decay
    setTimeout(() => {
        if (toast.parentElement) {
            toast.classList.remove('active');
            setTimeout(() => toast.remove(), 500);
        }
    }, 5000);
};

/* ─── MOUSE PARALLAX ────────────────────────────────── */
const heroTitle = document.querySelector('.hero-title');
if (heroTitle) {
    let tx = 0, ty = 0;
    document.addEventListener('mousemove', e => {
        const dx = (e.clientX - window.innerWidth / 2) * 0.015;
        const dy = (e.clientY - window.innerHeight / 2) * 0.01;
        tx += (dx - tx) * 0.1;
        ty += (dy - ty) * 0.1;
        heroTitle.style.transform = `translate(${tx}px, ${ty}px)`;
    });
}

/* ─── SKILLS MARQUEE CLONE (REMOVED JS IN FAVOR OF CSS) ─── */
// Duplication is now handled via PHP loops in the view for better performance

/* ─── COMMENT FORM (AJAX) ───────────────────────────── */
const commentForm = document.getElementById('comment-form');
const commentList = document.getElementById('comment-list');

if (commentForm) {
    commentForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const btn = commentForm.querySelector('.premium-submit');
        const nameInput = commentForm.querySelector('.minimal-input');
        const textarea = commentForm.querySelector('.minimal-textarea');
        const name = nameInput.value.trim();
        const text = textarea.value.trim();

        if (!text) {
            textarea.classList.add('error-shake');
            showToast('Harap tuliskan pesan Anda.', 'error');
            setTimeout(() => textarea.classList.remove('error-shake'), 500);
            return;
        }

        btn.disabled = true;
        btn.classList.add('dispatching');
        commentForm.classList.add('dispatching');
        const btnSpan = btn.querySelector('span');
        if (btnSpan) btnSpan.textContent = 'Mengirim...';

        try {
            const fd = new FormData(commentForm);
            if (!fd.get('name')) fd.set('name', 'Anonymous');

            // Add minimum wait time (1.4s) for professional 3D feel
            const minWait = new Promise(resolve => setTimeout(resolve, 1400));
            const fetchCall = fetch('/comments', {
                method: 'POST',
                body: fd,
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            });

            const [res] = await Promise.all([fetchCall, minWait]);
            const data = await res.json();

            if (data.success) {
                commentForm.classList.remove('dispatching');
                commentForm.classList.add('success-blast');
                setTimeout(() => commentForm.classList.remove('success-blast'), 1000);

                if (data.pending) {
                    showToast(data.message || 'Terima kasih! Pesan Anda sedang menunggu persetujuan.', 'success');
                } else {
                    prependComment(data.comment);
                    showToast('Pesan berhasil terdeploy!', 'success');
                }
                commentForm.reset();

                const notice = commentList.querySelector('.no-comments-v2');
                if (notice) notice.remove();
            } else {
                showToast(data.message || 'Gagal mengirim pesan.', 'error');
            }
        } catch (err) {
            console.error('Comment error:', err);
            showToast('Kesalahan saat mengirim pesan. Silakan coba lagi.', 'error');
        } finally {
            btn.disabled = false;
            btn.classList.remove('dispatching');
            commentForm.classList.remove('dispatching');
            btn.innerHTML = `<span>Send Comments</span><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5"/></svg>`;
        }
    });
}

function prependComment(c) {
    if (!commentList) return;
    const timeStr = c.time_ago || 'Baru saja';
    const div = document.createElement('div');
    div.className = 'comment-item';
    div.innerHTML = `
    <div class="comment-avatar">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z"/>
      </svg>
    </div>
    <div class="comment-body">
      <div class="comment-meta">
        <span class="comment-name">${escHtml(c.name)}</span>
        <span class="comment-time">${escHtml(timeStr)}</span>
      </div>
      <p class="comment-text">${escHtml(c.text)}</p>
    </div>
  `;
    commentList.prepend(div);

    // Auto-scroll to top of list
    commentList.scrollTo({ top: 0, behavior: 'smooth' });
}

function escHtml(str) {
    const d = document.createElement('div');
    d.textContent = str;
    return d.innerHTML;
}

/* ─── THREE.JS BADGE (Interactive Lanyard Card) ─────── */
(function initBadge() {
    if (typeof THREE === 'undefined') return;
    const canvas = document.getElementById('badge-canvas');
    if (!canvas) return;

    const renderer = new THREE.WebGLRenderer({ canvas, antialias: true, alpha: true });
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.shadowMap.enabled = true;

    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(40, 1, 0.1, 100);
    camera.position.set(0, 0, 10);

    // Lights
    scene.add(new THREE.AmbientLight(0xffffff, 0.5));
    const dirLight = new THREE.DirectionalLight(0xffffff, 1.2);
    dirLight.position.set(2, 5, 3);
    dirLight.castShadow = true;
    scene.add(dirLight);
    scene.add(new THREE.PointLight(0x4040ff, 0.3, 20));

    // Card geometry (Glass 3D effect)
    const cardGeo = new THREE.BoxGeometry(2.2, 3.5, 0.1);
    const cardMat = new THREE.MeshPhysicalMaterial({
        color: 0xffffff,
        metalness: 0.1,
        roughness: 0.05,
        transmission: 0.9,      // Glass transparency
        thickness: 0.5,         // Refraction thickness
        ior: 1.5,               // Index of refraction
        transparent: true,
        opacity: 0.4,
        clearcoat: 1,
        clearcoatRoughness: 0.05,
    });
    const card = new THREE.Mesh(cardGeo, cardMat);
    card.position.set(0, -0.5, 0);
    card.castShadow = true;
    scene.add(card);

    // Photo texture on card front (Full box)
    const loader = new THREE.TextureLoader();
    const photoUrl = canvas.dataset.photo || '/assets/images/profile.jpg';
    loader.load(photoUrl, tex => {
        // Use aspect-aware mapping or just stretch to fit "full" as requested
        const planeMat = new THREE.MeshPhysicalMaterial({
            map: tex,
            roughness: 0.2,
            clearcoat: 1,
            transparent: true,
            opacity: 0.9 // Keep photo mostly opaque on glass
        });
        // Match card dimensions (2.2 x 3.5)
        const photo = new THREE.Mesh(new THREE.PlaneGeometry(2.2, 3.5), planeMat);
        photo.position.set(0, 0, 0.051); // Slightly in front of glass
        card.add(photo);
    });

    // Lanyard string (tube)
    function makeLanyard(points) {
        const curve = new THREE.CatmullRomCurve3(points);
        const geo = new THREE.TubeGeometry(curve, 20, 0.025, 8, false);
        const mat = new THREE.MeshPhysicalMaterial({ color: 0x111111, roughness: 0.6 });
        return new THREE.Mesh(geo, mat);
    }
    let lanyardMesh = makeLanyard([
        new THREE.Vector3(0, 3.5, 0),
        new THREE.Vector3(-0.5, 2, 0),
        new THREE.Vector3(0.3, 0.8, 0),
        new THREE.Vector3(0, 1.1, 0),
    ]);
    scene.add(lanyardMesh);

    // Physics simulation (spring-damper)
    let cardVel = new THREE.Vector3();
    let cardPos = new THREE.Vector3(0, -0.5, 0);
    const gravity = -9.81 * 0.004;
    const damping = 0.88;
    const anchorY = 3.5;
    const ropeLength = 4.0;

    // Drag - Mouse
    let isDragging = false, isInView = false;
    const mouse = new THREE.Vector2();
    const raycaster = new THREE.Raycaster();

    canvas.addEventListener('mousedown', e => {
        raycaster.setFromCamera(getMouseNDC(e), camera);
        const hits = raycaster.intersectObject(card);
        if (hits.length) {
            isDragging = true;
            canvas.style.cursor = 'grabbing';
        }
    });

    window.addEventListener('mousemove', e => {
        mouse.set(getMouseNDC(e).x, getMouseNDC(e).y);
        if (isDragging) {
            const vec = new THREE.Vector3(mouse.x * 5, mouse.y * 5, 0);
            cardVel.set(0, 0, 0);
            cardPos.lerp(vec, 0.3);
        }
    });

    window.addEventListener('mouseup', () => {
        isDragging = false;
        canvas.style.cursor = 'grab';
    });

    // Drag - Touch (Mobile)
    canvas.addEventListener('touchstart', e => {
        if (e.touches.length > 0) {
            const touch = e.touches[0];
            raycaster.setFromCamera(getMouseNDC(touch), camera);
            const hits = raycaster.intersectObject(card);
            if (hits.length) {
                isDragging = true;
                // Prevent scrolling while dragging lanyard
                if (e.cancelable) e.preventDefault();
            }
        }
    }, { passive: false });

    window.addEventListener('touchmove', e => {
        if (isDragging && e.touches.length > 0) {
            const touch = e.touches[0];
            const ndc = getMouseNDC(touch);
            mouse.set(ndc.x, ndc.y);
            const vec = new THREE.Vector3(mouse.x * 5, mouse.y * 5, 0);
            cardVel.set(0, 0, 0);
            cardPos.lerp(vec, 0.3);
            // Prevent scrolling while moving lanyard
            if (e.cancelable) e.preventDefault();
        }
    }, { passive: false });

    window.addEventListener('touchend', () => {
        isDragging = false;
    });

    function getMouseNDC(e) {
        const rect = canvas.getBoundingClientRect();
        return new THREE.Vector2(
            ((e.clientX - rect.left) / rect.width) * 2 - 1,
            -((e.clientY - rect.top) / rect.height) * 2 + 1,
        );
    }

    // IntersectionObserver for lazy physics
    new IntersectionObserver(([entry]) => {
        if (entry.isIntersecting && !isInView) {
            // Start falling from top when scrolled into view
            cardPos.set(Math.random() * 0.5 - 0.25, 5, 2);
            cardVel.set(0, -0.15, -0.05);
        }
        isInView = entry.isIntersecting;
    }, { threshold: 0.1 }).observe(canvas.parentElement);

    function resize() {
        const w = canvas.parentElement.clientWidth;
        const h = canvas.parentElement.clientHeight;
        renderer.setSize(w, h);
        camera.aspect = w / h;
        camera.updateProjectionMatrix();
    }
    resize();
    window.addEventListener('resize', resize);

    // Animate
    let t = 0;
    (function animate() {
        requestAnimationFrame(animate);
        t += 0.016;

        if (!isDragging) {
            // Rope constraint
            const toAnchor = new THREE.Vector3(0, anchorY, 0).sub(cardPos);
            const dist = toAnchor.length();
            if (dist > ropeLength) {
                const correction = toAnchor.normalize().multiplyScalar((dist - ropeLength) * 0.5);
                cardPos.add(correction);
                cardVel.add(correction.clone().multiplyScalar(0.3));
            }
            // Gravity + damping
            cardVel.y += gravity;
            cardVel.multiplyScalar(damping);
            // Gentle sway when in view
            if (isInView) {
                cardVel.x += Math.sin(t * 0.4) * 0.002;
            }
            cardPos.add(cardVel);
            // Floor
            if (cardPos.y < -3) { cardPos.y = -3; cardVel.y *= -0.4; }
        }

        card.position.copy(cardPos);

        // Correct Billboarding: Face camera but allow for physics-based tilt
        // We calculate a baseline rotation to face the camera, 
        // then we can apply physics-based perturbations if needed.
        card.quaternion.copy(camera.quaternion);

        // Add a subtle wobble based on velocity for more "weight"
        const tiltX = cardVel.y * 2;
        const tiltY = -cardVel.x * 2;
        card.rotateX(tiltX);
        card.rotateY(tiltY);

        // Rebuild lanyard with smoother, more accurate points
        scene.remove(lanyardMesh);
        lanyardMesh.geometry.dispose();

        // The lanyard should attach to the top center of the card
        const attachPoint = new THREE.Vector3(0, 1.75, 0); // Top of 3.5 height card
        attachPoint.applyMatrix4(card.matrixWorld);

        const midX = (cardPos.x * 0.5);
        lanyardMesh = makeLanyard([
            new THREE.Vector3(0, anchorY, 0),
            new THREE.Vector3(midX * 0.4, anchorY - 1.0, 0.2),
            new THREE.Vector3(attachPoint.x * 0.8, attachPoint.y + 0.5, attachPoint.z * 0.5),
            attachPoint,
        ]);
        scene.add(lanyardMesh);

        renderer.render(scene, camera);
    })();

    canvas.style.cursor = 'grab';
})();
