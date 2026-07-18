/**
 * Industry detail page — ambient particles, motifs, reveals, scenarios.
 */
(function () {
    'use strict';

    var page = document.querySelector('[data-ix-page]');
    if (!page) {
        return;
    }

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var industry = page.getAttribute('data-industry') || 'education';

    var MOTIFS = {
        education: [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M2 9.5L12 4l10 5.5-10 5.5L2 9.5z"/><path d="M6 12v5.5c0 .8 2.7 2.5 6 2.5s6-1.7 6-2.5V12"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 19V5h10v14"/><path d="M14 5h6v14h-6"/><path d="M8 9h3M8 12h3"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l1.5 4.5L18 9l-4.5 1.5L12 15l-1.5-4.5L6 9l4.5-1.5L12 3z"/><path d="M5 19h14"/></svg>',
        ],
        healthcare: [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M19.5 5.5a4.5 4.5 0 0 0-6.4 0L12 6.6l-1.1-1.1a4.5 4.5 0 0 0-6.4 6.4L12 19.5l7.5-7.6a4.5 4.5 0 0 0 0-6.4z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 5v14M5 12h14"/><rect x="3" y="3" width="18" height="18" rx="3"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 12h3l2-5 3 10 2-5h8"/></svg>',
        ],
        fintech: [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 19V9l4 3 4-6 4 4 4-5v14z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="8"/><path d="M12 8v8M9 10h4.5a1.5 1.5 0 0 1 0 3H10"/></svg>',
        ],
        retail: [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M6 8h12l1 11H5L6 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 7h16v12H4z"/><path d="M8 7V5a4 4 0 0 1 8 0v2"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 7h18l-2 12H5L3 7z"/><path d="M8 11v2M12 11v2M16 11v2"/></svg>',
        ],
        'real-estate': [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 21h18M5 21V9l7-5 7 5v12M9 21v-6h6v6"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 20V10l8-5 8 5v10"/><path d="M10 20v-5h4v5"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3l9 7v11H3V10l9-7z"/></svg>',
        ],
        logistics: [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M1 12h4l3 5h8l3-5h4"/><circle cx="5" cy="19" r="2"/><circle cx="15" cy="19" r="2"/><path d="M1 12V7h10v5"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 3v18M5 10l7-7 7 7"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="7" width="18" height="12" rx="2"/><path d="M3 11h18"/></svg>',
        ],
        'food-restaurants': [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M8 3v8a2 2 0 0 0 4 0V3M10 13v8M16 3v18M16 8h3a2 2 0 0 1 0 4h-3"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M12 4c-3 0-5 3-5 6 0 4 5 10 5 10s5-6 5-10c0-3-2-6-5-6z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="8"/><path d="M8 12h8M12 8v8"/></svg>',
        ],
        'travel-hospitality': [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M21 16.5l-7.5-2.3L9 19l-1.5-1 3.2-4.8L3 10.5l.8-1.7L12 11l7.2-8.5L21 4v12.5z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M3 11h18v9H3z"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/></svg>',
        ],
        'on-demand': [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M13 2L4 14h7l-1 8 10-14h-7l0-6z"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="3"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 7h16v10H4z"/><path d="M8 7V5h8v2"/></svg>',
        ],
        'saas-b2b': [
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 19V5h16v14"/><path d="M8 15l3-4 2 2 3-5"/></svg>',
            '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.7 1.7 0 0 0 .3 1.8l.1.1a2 2 0 1 1-2.8 2.8l-.1-.1a1.7 1.7 0 0 0-1.8-.3 1.7 1.7 0 0 0-1 1.5V20a2 2 0 1 1-4 0v-.1a1.7 1.7 0 0 0-1-1.5 1.7 1.7 0 0 0-1.8.3l-.1.1a2 2 0 1 1-2.8-2.8l.1-.1a1.7 1.7 0 0 0 .3-1.8 1.7 1.7 0 0 0-1.5-1H4a2 2 0 1 1 0-4h.1a1.7 1.7 0 0 0 1.5-1 1.7 1.7 0 0 0-.3-1.8l-.1-.1a2 2 0 1 1 2.8-2.8l.1.1a1.7 1.7 0 0 0 1.8.3H10a1.7 1.7 0 0 0 1-1.5V4a2 2 0 1 1 4 0v.1a1.7 1.7 0 0 0 1 1.5 1.7 1.7 0 0 0 1.8-.3l.1-.1a2 2 0 1 1 2.8 2.8l-.1.1a1.7 1.7 0 0 0-.3 1.8V10c.2.7.8 1.2 1.5 1.2H20a2 2 0 1 1 0 4h-.1a1.7 1.7 0 0 0-1.5 1z"/></svg>',
        ],
    };

    function hexToRgb(hex) {
        var h = getComputedStyle(page).getPropertyValue('--ix-accent').trim() || '#e11d48';
        if (h.charAt(0) === '#') {
            h = h.slice(1);
        }
        if (h.length === 3) {
            h = h[0] + h[0] + h[1] + h[1] + h[2] + h[2];
        }
        var n = parseInt(h, 16);
        if (Number.isNaN(n)) {
            return { r: 225, g: 29, b: 72 };
        }
        return { r: (n >> 16) & 255, g: (n >> 8) & 255, b: n & 255 };
    }

    // Floating industry motifs
    var motifsHost = page.querySelector('[data-ix-motifs]');
    if (motifsHost && !reduceMotion) {
        var set = MOTIFS[industry] || MOTIFS.education;
        var count = 10;
        for (var m = 0; m < count; m++) {
            var el = document.createElement('div');
            el.className = 'ix-motif';
            el.innerHTML = set[m % set.length];
            el.style.left = 6 + Math.random() * 88 + '%';
            el.style.top = 8 + Math.random() * 84 + '%';
            el.style.animationDelay = -Math.random() * 10 + 's';
            el.style.animationDuration = 10 + Math.random() * 10 + 's';
            el.style.opacity = String(0.12 + Math.random() * 0.16);
            el.style.width = 1.6 + Math.random() * 1.4 + 'rem';
            el.style.height = el.style.width;
            motifsHost.appendChild(el);
        }
    }

    // Pointer glow
    var glow = page.querySelector('[data-ix-glow]');
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.25;
        var targetX = glowX;
        var targetY = glowY;
        var glowRaf = null;

        function paintGlow() {
            glowX += (targetX - glowX) * 0.08;
            glowY += (targetY - glowY) * 0.08;
            glow.style.left = glowX + 'px';
            glow.style.top = glowY + 'px';
            glowRaf = requestAnimationFrame(paintGlow);
        }

        window.addEventListener(
            'pointermove',
            function (e) {
                targetX = e.clientX;
                targetY = e.clientY;
                glow.classList.add('is-on');
                if (!glowRaf) {
                    glowRaf = requestAnimationFrame(paintGlow);
                }
            },
            { passive: true }
        );
    }

    // Particle canvas
    var canvas = page.querySelector('[data-ix-canvas]');
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext('2d');
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var running = true;
        var rgb = hexToRgb();

        function size() {
            return {
                w: page.clientWidth || window.innerWidth,
                h: Math.max(page.clientHeight || 0, window.innerHeight),
            };
        }

        function resize() {
            var s = size();
            canvas.width = Math.floor(s.w * dpr);
            canvas.height = Math.floor(s.h * dpr);
            canvas.style.width = s.w + 'px';
            canvas.style.height = s.h + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            rgb = hexToRgb();

            var count = Math.min(64, Math.floor((s.w * s.h) / 22000));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * s.w,
                    y: Math.random() * s.h,
                    r: 0.5 + Math.random() * 1.8,
                    vx: (Math.random() - 0.5) * 0.35,
                    vy: -0.1 - Math.random() * 0.35,
                    a: 0.1 + Math.random() * 0.28,
                    pulse: Math.random() * Math.PI * 2,
                });
            }
        }

        function draw() {
            if (!running) {
                return;
            }
            var s = size();
            ctx.clearRect(0, 0, s.w, s.h);

            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.pulse += 0.02;
                p.x += p.vx + Math.sin(p.pulse) * 0.08;
                p.y += p.vy;
                if (p.y < -6) {
                    p.y = s.h + 6;
                    p.x = Math.random() * s.w;
                }
                if (p.x < -6) {
                    p.x = s.w + 6;
                }
                if (p.x > s.w + 6) {
                    p.x = -6;
                }

                var alpha = p.a * (0.7 + 0.3 * Math.sin(p.pulse));
                ctx.beginPath();
                ctx.fillStyle = 'rgba(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + alpha + ')';
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();

                for (var j = i + 1; j < particles.length; j++) {
                    var q = particles[j];
                    var dx = p.x - q.x;
                    var dy = p.y - q.y;
                    var dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 100) {
                        ctx.beginPath();
                        ctx.strokeStyle =
                            'rgba(' + rgb.r + ',' + rgb.g + ',' + rgb.b + ',' + 0.09 * (1 - dist / 100) + ')';
                        ctx.lineWidth = 1;
                        ctx.moveTo(p.x, p.y);
                        ctx.lineTo(q.x, q.y);
                        ctx.stroke();
                    }
                }
            }

            requestAnimationFrame(draw);
        }

        resize();
        draw();
        window.addEventListener('resize', resize);
        document.addEventListener('visibilitychange', function () {
            running = !document.hidden;
            if (running) {
                draw();
            }
        });
    }

    // Scroll reveals
    var reveals = page.querySelectorAll('[data-ix-reveal]');
    if (reveals.length) {
        if (reduceMotion || !('IntersectionObserver' in window)) {
            reveals.forEach(function (el) {
                el.classList.add('is-in');
            });
        } else {
            var obs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-in');
                            obs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.14, rootMargin: '0px 0px -6% 0px' }
            );
            reveals.forEach(function (el) {
                obs.observe(el);
            });
        }
    }

    // Scenario accordion
    var scenarios = page.querySelectorAll('[data-ix-scenario]');
    scenarios.forEach(function (item) {
        var tab = item.querySelector('[data-ix-scenario-tab]');
        if (!tab) {
            return;
        }
        tab.addEventListener('click', function () {
            scenarios.forEach(function (other) {
                other.classList.toggle('is-active', other === item);
            });
        });
    });

    // Cap pointer spotlight
    if (!reduceMotion) {
        page.querySelectorAll('[data-ix-cap]').forEach(function (cap) {
            cap.addEventListener('pointermove', function (e) {
                var rect = cap.getBoundingClientRect();
                var x = ((e.clientX - rect.left) / rect.width) * 100;
                var y = ((e.clientY - rect.top) / rect.height) * 100;
                cap.style.setProperty('--mx', x + '%');
                cap.style.setProperty('--my', y + '%');
            });
        });
    }
})();
