/**
 * Industries page — explorer, orbit sync, particles, pointer glow.
 */
(function () {
    'use strict';

    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var stage = document.querySelector('[data-ind-stage]');
    var root = document.querySelector('[data-ind-explorer]');
    if (!root) {
        return;
    }

    var panel = root.querySelector('[data-ind-panel]');
    var filters = root.querySelectorAll('[data-ind-filter]');
    var items = Array.prototype.slice.call(root.querySelectorAll('.ind-list__item'));
    var orbitNodes = Array.prototype.slice.call(document.querySelectorAll('[data-ind-orbit-node]'));
    var orbitCore = document.querySelector('[data-ind-orbit-core]');
    var panelIcon = panel ? panel.querySelector('[data-ind-panel-icon]') : null;
    var iconBank = document.querySelector('[data-ind-icon-bank]');
    var groups = {};

    try {
        groups = JSON.parse(root.getAttribute('data-ind-groups') || '{}');
    } catch (e) {
        groups = {};
    }

    var panelGroup = panel.querySelector('[data-ind-panel-group]');
    var panelTitle = panel.querySelector('[data-ind-panel-title]');
    var panelDetail = panel.querySelector('[data-ind-panel-detail]');
    var panelBuilds = panel.querySelector('[data-ind-panel-builds]');
    var panelGuide = panel.querySelector('[data-ind-panel-guide]');
    var showBase = (root.getAttribute('data-ind-show-base') || '/industries').replace(/\/$/, '');
    var mq = window.matchMedia('(max-width: 900px)');

    function parseBuilds(el) {
        try {
            var parsed = JSON.parse(el.getAttribute('data-ind-builds') || '[]');
            return Array.isArray(parsed) ? parsed : [];
        } catch (e) {
            return [];
        }
    }

    function fillBuilds(ul, builds) {
        ul.innerHTML = '';
        builds.forEach(function (line) {
            var li = document.createElement('li');
            li.textContent = line;
            ul.appendChild(li);
        });
    }

    function cloneIcon(slug, size) {
        if (!iconBank) {
            return null;
        }
        var attr = size === 'xl' ? 'data-ind-icon-tpl-xl' : 'data-ind-icon-tpl';
        var tpl = iconBank.querySelector('[' + attr + '="' + slug + '"]');
        if (!tpl) {
            return null;
        }
        return tpl.content.cloneNode(true);
    }

    function swapIcon(host, slug, size, swapClass) {
        if (!host) {
            return;
        }
        var frag = cloneIcon(slug, size);
        if (!frag) {
            return;
        }
        host.innerHTML = '';
        host.appendChild(frag);
        if (!reduceMotion && swapClass) {
            host.classList.remove(swapClass);
            void host.offsetWidth;
            host.classList.add(swapClass);
            window.setTimeout(function () {
                host.classList.remove(swapClass);
            }, 520);
        }
    }

    function visibleItems() {
        return items.filter(function (item) {
            return !item.hidden && !item.classList.contains('is-filtered-out');
        });
    }

    function syncOrbit(slug) {
        orbitNodes.forEach(function (node) {
            node.classList.toggle('is-active', node.getAttribute('data-ind-slug') === slug);
        });
        swapIcon(orbitCore, slug, 'xl', 'is-swap');
    }

    function updatePanel(item) {
        var groupKey = item.getAttribute('data-ind-group') || '';
        var slug = item.getAttribute('data-ind-slug') || '';
        var name = item.getAttribute('data-ind-name') || '';
        var detail = item.getAttribute('data-ind-detail') || '';
        var builds = parseBuilds(item);

        if (panel && !reduceMotion) {
            panel.classList.remove('is-changing');
            void panel.offsetWidth;
            panel.classList.add('is-changing');
        }

        panelGroup.textContent = groups[groupKey] || '';
        panelTitle.textContent = name;
        panelDetail.textContent = detail;
        fillBuilds(panelBuilds, builds);
        swapIcon(panelIcon, slug, 'lg', 'is-swap');
        syncOrbit(slug);

        if (panelGuide) {
            panelGuide.href = showBase + '/' + slug;
        }

        items.forEach(function (el) {
            var mobile = el.querySelector('[data-ind-mobile-detail]');
            if (!mobile) {
                return;
            }
            if (el === item && mq.matches) {
                var text = mobile.querySelector('[data-ind-mobile-text]');
                var buildsUl = mobile.querySelector('[data-ind-mobile-builds]');
                var mobileGuide = mobile.querySelector('[data-ind-mobile-guide]');
                if (text) {
                    text.textContent = detail;
                }
                if (buildsUl) {
                    fillBuilds(buildsUl, builds);
                }
                if (mobileGuide) {
                    mobileGuide.href = showBase + '/' + slug;
                }
                mobile.hidden = false;
            } else {
                mobile.hidden = true;
            }
        });
    }

    function selectItem(item, focus) {
        if (!item || item.classList.contains('is-filtered-out')) {
            return;
        }

        items.forEach(function (el) {
            var on = el === item;
            el.classList.toggle('is-selected', on);
            el.setAttribute('aria-selected', on ? 'true' : 'false');
            el.tabIndex = on ? 0 : -1;
        });

        updatePanel(item);

        if (focus) {
            item.focus({ preventScroll: true });
            item.scrollIntoView({ block: 'nearest', behavior: reduceMotion ? 'auto' : 'smooth' });
        }
    }

    function selectBySlug(slug, focus) {
        var match = items.find(function (item) {
            return item.getAttribute('data-ind-slug') === slug && !item.classList.contains('is-filtered-out');
        });
        if (match) {
            selectItem(match, focus);
        }
    }

    function applyFilter(group) {
        filters.forEach(function (btn) {
            var on = btn.getAttribute('data-ind-filter') === group;
            btn.classList.toggle('is-active', on);
            btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        });

        items.forEach(function (item) {
            var match = group === 'all' || item.getAttribute('data-ind-group') === group;
            item.classList.toggle('is-filtered-out', !match);
            item.hidden = !match;
        });

        orbitNodes.forEach(function (node) {
            var slug = node.getAttribute('data-ind-slug');
            var listItem = items.find(function (item) {
                return item.getAttribute('data-ind-slug') === slug;
            });
            var show = !listItem || !listItem.classList.contains('is-filtered-out');
            node.hidden = !show;
            node.style.visibility = show ? '' : 'hidden';
        });

        var next = visibleItems()[0];
        if (next) {
            selectItem(next, false);
        }
    }

    filters.forEach(function (btn) {
        btn.addEventListener('click', function () {
            applyFilter(btn.getAttribute('data-ind-filter') || 'all');
        });
    });

    items.forEach(function (item) {
        item.addEventListener('click', function (event) {
            if (event.target.closest('a')) {
                return;
            }
            selectItem(item, false);
        });

        item.addEventListener('keydown', function (event) {
            var key = event.key;
            var visible = visibleItems();
            var index = visible.indexOf(item);

            if (key === 'Enter' || key === ' ') {
                event.preventDefault();
                selectItem(item, false);
                return;
            }
            if (key === 'ArrowDown' || key === 'ArrowRight') {
                event.preventDefault();
                if (index > -1 && index < visible.length - 1) {
                    selectItem(visible[index + 1], true);
                }
                return;
            }
            if (key === 'ArrowUp' || key === 'ArrowLeft') {
                event.preventDefault();
                if (index > 0) {
                    selectItem(visible[index - 1], true);
                }
                return;
            }
            if (key === 'Home') {
                event.preventDefault();
                if (visible[0]) {
                    selectItem(visible[0], true);
                }
                return;
            }
            if (key === 'End') {
                event.preventDefault();
                if (visible.length) {
                    selectItem(visible[visible.length - 1], true);
                }
            }
        });
    });

    orbitNodes.forEach(function (node) {
        node.addEventListener('click', function () {
            var slug = node.getAttribute('data-ind-slug');
            selectBySlug(slug, true);
        });

        node.addEventListener('dblclick', function () {
            var slug = node.getAttribute('data-ind-slug');
            if (slug) {
                window.location.href = showBase + '/' + slug;
            }
        });
    });

    function onBreakpointChange() {
        var selected = root.querySelector('.ind-list__item.is-selected');
        if (selected) {
            updatePanel(selected);
        }
    }

    if (typeof mq.addEventListener === 'function') {
        mq.addEventListener('change', onBreakpointChange);
    } else if (typeof mq.addListener === 'function') {
        mq.addListener(onBreakpointChange);
    }

    // Pointer glow
    var glow = document.querySelector('[data-ind-glow]');
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.28;
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

    // Particle field scoped to stage height
    var canvas = document.querySelector('[data-ind-canvas]');
    if (canvas && stage && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext('2d');
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var running = true;

        function stageSize() {
            return {
                w: stage.clientWidth || window.innerWidth,
                h: Math.max(stage.clientHeight || 0, window.innerHeight),
            };
        }

        function resizeCanvas() {
            var size = stageSize();
            canvas.width = Math.floor(size.w * dpr);
            canvas.height = Math.floor(size.h * dpr);
            canvas.style.width = size.w + 'px';
            canvas.style.height = size.h + 'px';
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            var count = Math.min(56, Math.floor((size.w * size.h) / 24000));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * size.w,
                    y: Math.random() * size.h,
                    r: 0.55 + Math.random() * 1.5,
                    vx: (Math.random() - 0.5) * 0.28,
                    vy: -0.12 - Math.random() * 0.32,
                    a: 0.1 + Math.random() * 0.26,
                    link: Math.random() > 0.55,
                });
            }
        }

        function drawParticles() {
            if (!running) {
                return;
            }
            var size = stageSize();
            ctx.clearRect(0, 0, size.w, size.h);

            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx;
                p.y += p.vy;
                if (p.y < -4) {
                    p.y = size.h + 4;
                    p.x = Math.random() * size.w;
                }
                if (p.x < -4) {
                    p.x = size.w + 4;
                }
                if (p.x > size.w + 4) {
                    p.x = -4;
                }

                ctx.beginPath();
                ctx.fillStyle = 'rgba(225, 29, 72,' + p.a + ')';
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();

                if (p.link) {
                    for (var j = i + 1; j < particles.length; j++) {
                        var q = particles[j];
                        if (!q.link) {
                            continue;
                        }
                        var dx = p.x - q.x;
                        var dy = p.y - q.y;
                        var dist = Math.sqrt(dx * dx + dy * dy);
                        if (dist < 90) {
                            ctx.beginPath();
                            ctx.strokeStyle = 'rgba(225, 29, 72,' + (0.08 * (1 - dist / 90)) + ')';
                            ctx.lineWidth = 1;
                            ctx.moveTo(p.x, p.y);
                            ctx.lineTo(q.x, q.y);
                            ctx.stroke();
                        }
                    }
                }
            }

            requestAnimationFrame(drawParticles);
        }

        resizeCanvas();
        drawParticles();
        window.addEventListener('resize', resizeCanvas);
        document.addEventListener('visibilitychange', function () {
            running = !document.hidden;
            if (running) {
                drawParticles();
            }
        });
    }

    var initial = root.querySelector('.ind-list__item.is-selected') || items[0];
    if (initial) {
        selectItem(initial, false);
    }
})();
