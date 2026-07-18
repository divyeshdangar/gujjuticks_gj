(function () {
    if (!document.body.classList.contains("site-body--news")) return;

    var hub = document.querySelector("[data-nw-hub]");
    if (!hub) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Typewriter
    var typeEl = hub.querySelector("[data-nw-type]");
    if (typeEl) {
        var phrases = [
            "Gujarat updates",
            "India headlines",
            "local briefs",
            "topic desks",
            "daily wrap-ups",
        ];
        var phraseIdx = 0;
        var charIdx = phrases[0].length;
        var deleting = false;
        var typePaused = false;

        function typeTick() {
            if (typePaused || reduceMotion) return;
            var current = phrases[phraseIdx];
            if (!deleting) {
                charIdx += 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx >= current.length) {
                    deleting = true;
                    typePaused = true;
                    window.setTimeout(function () {
                        typePaused = false;
                        typeTick();
                    }, 1400);
                    return;
                }
            } else {
                charIdx -= 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx <= 0) {
                    deleting = false;
                    phraseIdx = (phraseIdx + 1) % phrases.length;
                }
            }
            window.setTimeout(typeTick, deleting ? 36 : 58);
        }

        if (!reduceMotion) window.setTimeout(typeTick, 900);
    }

    // Local time
    function updateTime() {
        var el = hub.querySelector("[data-nw-time]");
        if (!el) return;
        try {
            el.textContent =
                "India · " +
                new Intl.DateTimeFormat("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "numeric",
                    minute: "2-digit",
                    hour12: true,
                }).format(new Date());
        } catch (e) {
            el.textContent = "India time";
        }
    }
    updateTime();
    setInterval(updateTime, 30000);

    // Edition plate (hub) — flip categories + date
    var edition = hub.querySelector("[data-nw-edition]");
    if (edition) {
        var names = Array.prototype.slice.call(
            edition.querySelectorAll("[data-nw-edition-name]")
        );
        var subEl = edition.querySelector("[data-nw-edition-sub]");
        var dateEl = edition.querySelector("[data-nw-edition-date]");
        var eIdx = 0;

        function updateEditionDate() {
            if (!dateEl) return;
            try {
                dateEl.textContent = new Intl.DateTimeFormat("en-IN", {
                    timeZone: "Asia/Kolkata",
                    weekday: "short",
                    day: "numeric",
                    month: "short",
                }).format(new Date());
            } catch (e) {
                dateEl.textContent = "Today";
            }
        }
        updateEditionDate();

        function showEdition(next) {
            if (!names.length) return;
            var cur = names[eIdx];
            eIdx = ((next % names.length) + names.length) % names.length;
            var upcoming = names[eIdx];

            if (cur && cur !== upcoming) {
                cur.classList.remove("is-on");
                cur.classList.add("is-out");
                window.setTimeout(function () {
                    cur.classList.remove("is-out");
                }, 520);
            }

            upcoming.classList.add("is-on");
            if (subEl) {
                var topics = parseInt(upcoming.getAttribute("data-topics"), 10) || 0;
                subEl.textContent = topics > 0
                    ? topics + " topic desks inside"
                    : "Open the category for latest stories";
            }
        }

        if (names.length) names[0].classList.add("is-on");

        if (!reduceMotion && names.length > 1) {
            setInterval(function () {
                showEdition(eIdx + 1);
            }, 2800);
        }
    }

    // Scroll progress
    var progress = hub.querySelector("[data-nw-progress]");
    if (progress) {
        function updateProgress() {
            var doc = document.documentElement;
            var max = doc.scrollHeight - window.innerHeight;
            var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
            progress.style.width = pct.toFixed(2) + "%";
        }
        updateProgress();
        window.addEventListener("scroll", updateProgress, { passive: true });
    }

    // Pointer glow
    var glow = hub.querySelector("[data-nw-glow]");
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.3;
        var targetX = glowX;
        var targetY = glowY;
        var glowRaf = 0;

        function paintGlow() {
            glowX += (targetX - glowX) * 0.12;
            glowY += (targetY - glowY) * 0.12;
            glow.style.left = glowX + "px";
            glow.style.top = glowY + "px";
            glowRaf = requestAnimationFrame(paintGlow);
        }

        window.addEventListener(
            "pointermove",
            function (e) {
                targetX = e.clientX;
                targetY = e.clientY;
                glow.classList.add("is-on");
                if (!glowRaf) glowRaf = requestAnimationFrame(paintGlow);
            },
            { passive: true }
        );
    }

    // Soft particles
    var canvas = hub.querySelector("[data-nw-particles]");
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var running = true;

        function resizeCanvas() {
            var w = window.innerWidth;
            var h = window.innerHeight;
            canvas.width = Math.floor(w * dpr);
            canvas.height = Math.floor(h * dpr);
            canvas.style.width = w + "px";
            canvas.style.height = h + "px";
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            var count = Math.min(36, Math.floor((w * h) / 32000));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    r: 0.6 + Math.random() * 1.3,
                    vx: (Math.random() - 0.5) * 0.2,
                    vy: -0.12 - Math.random() * 0.28,
                    a: 0.1 + Math.random() * 0.22,
                });
            }
        }

        function drawParticles() {
            if (!running) return;
            var w = window.innerWidth;
            var h = window.innerHeight;
            ctx.clearRect(0, 0, w, h);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx;
                p.y += p.vy;
                if (p.y < -4) {
                    p.y = h + 4;
                    p.x = Math.random() * w;
                }
                if (p.x < -4) p.x = w + 4;
                if (p.x > w + 4) p.x = -4;
                ctx.beginPath();
                ctx.fillStyle = "rgba(225, 29, 72," + p.a + ")";
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
            }
            requestAnimationFrame(drawParticles);
        }

        resizeCanvas();
        drawParticles();
        window.addEventListener("resize", resizeCanvas);
        document.addEventListener("visibilitychange", function () {
            running = !document.hidden;
            if (running) drawParticles();
        });
    }

    // Reveal
    var revealEls = hub.querySelectorAll(".nw-reveal");
    if (revealEls.length) {
        if (reduceMotion || !("IntersectionObserver" in window)) {
            revealEls.forEach(function (el) {
                el.classList.add("is-in");
            });
        } else {
            var revealObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("is-in");
                            revealObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.12, rootMargin: "0px 0px -6% 0px" }
            );
            revealEls.forEach(function (el) {
                revealObs.observe(el);
            });
        }
    }

    // Desk prompter (category detail) — rising feed + focus band
    var prompter = hub.querySelector("[data-nw-prompter]");
    if (prompter) {
        var track = prompter.querySelector("[data-nw-prompter-track]");
        var items = Array.prototype.slice.call(
            prompter.querySelectorAll("[data-nw-prompter-item]")
        );
        var bar = prompter.querySelector("[data-nw-prompter-bar]");
        var statusEl = prompter.querySelector("[data-nw-prompter-status]");
        var clockEl = prompter.querySelector("[data-nw-prompter-clock]");
        var total = items.length;
        var idx = 0;
        var stepMs = 3400;
        var startedAt = performance.now();
        var running = true;

        function pad2(n) {
            return n < 10 ? "0" + n : String(n);
        }

        function updateClock() {
            if (!clockEl) return;
            try {
                clockEl.textContent = new Intl.DateTimeFormat("en-IN", {
                    timeZone: "Asia/Kolkata",
                    hour: "2-digit",
                    minute: "2-digit",
                    hour12: false,
                }).format(new Date());
            } catch (e) {
                clockEl.textContent = "";
            }
        }
        updateClock();
        setInterval(updateClock, 30000);

        function goTo(nextIdx) {
            idx = ((nextIdx % total) + total) % total;
            items.forEach(function (item, i) {
                item.classList.remove("is-active", "is-near");
                if (i === idx) item.classList.add("is-active");
                else if (i === (idx + 1) % total || i === (idx - 1 + total) % total) {
                    item.classList.add("is-near");
                }
            });

            if (track && items[idx]) {
                var viewport = prompter.querySelector(".nw-prompter__viewport");
                var focusMid = viewport ? viewport.clientHeight / 2 : 0;
                var itemTop = items[idx].offsetTop;
                var itemMid = itemTop + items[idx].offsetHeight / 2;
                var y = focusMid - itemMid;
                track.style.transform = "translate3d(0, " + y + "px, 0)";
            }

            if (statusEl) {
                statusEl.textContent = "Reading " + pad2(idx + 1) + " / " + pad2(total);
            }

            startedAt = performance.now();
            if (bar) bar.style.width = "0%";
        }

        if (total) {
            // Initial layout after fonts/paint
            requestAnimationFrame(function () {
                goTo(0);
            });

            if (!reduceMotion && total > 1) {
                var ticking = false;
                function tick(now) {
                    if (!running) {
                        ticking = false;
                        return;
                    }
                    ticking = true;
                    var elapsed = now - startedAt;
                    var p = Math.min(1, elapsed / stepMs);
                    if (bar) bar.style.width = (p * 100).toFixed(1) + "%";
                    if (p >= 1) goTo(idx + 1);
                    requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);

                document.addEventListener("visibilitychange", function () {
                    running = !document.hidden;
                    if (running && !ticking) {
                        startedAt = performance.now();
                        requestAnimationFrame(tick);
                    }
                });
            } else if (bar) {
                bar.style.width = "100%";
            }
        }
    }

    // Count-up
    var counters = hub.querySelectorAll("[data-nw-count]");
    function animateCount(el) {
        var target = parseInt(el.getAttribute("data-nw-count"), 10) || 0;
        if (reduceMotion) {
            el.textContent = target.toLocaleString();
            return;
        }
        var started = performance.now();
        function frame(now) {
            var t = Math.min(1, (now - started) / 1100);
            var eased = 1 - Math.pow(1 - t, 3);
            el.textContent = Math.round(target * eased).toLocaleString();
            if (t < 1) requestAnimationFrame(frame);
        }
        requestAnimationFrame(frame);
    }

    if (counters.length) {
        if (!("IntersectionObserver" in window)) {
            counters.forEach(animateCount);
        } else {
            var countObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            countObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.4 }
            );
            counters.forEach(function (el) {
                countObs.observe(el);
            });
        }
    }
})();
